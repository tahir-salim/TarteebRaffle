<?php

namespace App\Services;

use App\Models\Raffle;
use App\Models\RaffleEntry;
use App\Models\Receipt;
use App\Models\Setting;

class RaffleService
{

    protected $raffle;

    public function __construct(Raffle $raffle)
    {
        $this->raffle = $raffle;
    }

    public function createWinner(Raffle $raffle)
    {
        $customerIds = [];
        $raffleEntries = $raffle->raffleEntries()
            // exclude old winners
            ->whereNotIn('customer_id', $raffle->raffleWinners()->pluck('customer_id'))
            ->get();

        if($raffleEntries->count() == 0){
            return;
        }

        foreach ($raffleEntries as $entry) {
            for ($i = 0; $i < $entry->number_of_entries; $i++) {
                $customerIds[] = $entry->customer_id;
            }
        }

        $winnerId = rand(0, count($customerIds) - 1);
        $winnerId = $customerIds[$winnerId];

        $raffle->winners()->syncWithoutDetaching($winnerId);
    }

    public function updateEntries(Raffle $raffle)
    {
        $entries = $this->calculateRaffleEntries($raffle, $this->getEntryAmount());
        foreach($entries as $entry){

            $raffleEntry = RaffleEntry::updateOrCreate(
                [
                    'raffle_id' => $entry->raffle_id,
                    'customer_id' => $entry->customer_id,
                ],
                [
                    'total_amount' => $entry->total_amount,
                    'number_of_entries' => $entry->number_of_entries
                ]
            );

            $raffleEntry->receipts()->sync(explode(',', $entry->receiptIds));
        }

    }

    public function calculateRaffleEntries($raffle, $entryAmount)
    {
        return Receipt::whereBetween('purchase_date', [$raffle->start_date, $raffle->end_date->endOfDay()])
            ->groupBy('customer_id')
            ->selectRaw('customer_id,sum(amount) as total_amount, GROUP_CONCAT(id) AS receiptIds')
            ->havingRaw('total_amount >= ' . $entryAmount)
            ->get()
            ->map(function ($receipt) use ($entryAmount, $raffle) {
                $receipt->number_of_entries = floor($receipt->total_amount / $entryAmount);
                $receipt->raffle_id = $raffle->id;
                return $receipt;
            });
    }

    public function getEntryAmount()
    {
        $minEntryAmount = Setting::MinEntryAmount()->first();
        if ($minEntryAmount) {
            return $minEntryAmount->value > 0 ? $minEntryAmount->value : 1;
        }
        return 1;
    }
}
