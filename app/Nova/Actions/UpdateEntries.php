<?php

namespace App\Nova\Actions;

use App\Services\RaffleService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class UpdateEntries extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Get the fields available on the action.
     *
     * @var RaffleService
     */
    protected $raffleService;

    public function __construct()
    {
        $this->raffleService = resolve(RaffleService::class);
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach($models as $raffle){
            $this->raffleService->updateEntries($raffle);
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
