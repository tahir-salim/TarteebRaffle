<?php

namespace App\Exports;

use App\Models\RaffleEntry;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RaffleEntryExport implements FromCollection, WithProperties, WithTitle, WithMapping, WithHeadings, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    use Exportable;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $raffleEntries = [];

    public function __construct($raffleEntries)
    {
        $this->raffleEntries = $raffleEntries;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Raffle Entries';
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->raffleEntries;
    }

    public function styles(Worksheet $sheet)
    {
        return [

            // Style the first row as bold text.
            1 => [
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
        ];
    }

    /**
     * @var User $player
     */
    public function map($raffleEntries): array
    {
        $fields = [

            optional($raffleEntries->customer)->name,
            optional($raffleEntries->raffle)->name,
            $raffleEntries->total_amount,
            $raffleEntries->number_of_entries,

        ];

        return $fields;
    }

    public function headings(): array
    {
        return [

            'Customer Id',
            'Raffle Id',
            'Total Amount',
            'Number Of Entries'
        ];
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            //
        ];
    }

    public function properties(): array
    {
        return [

            'creator' => 'Raffle',
            'lastModifiedBy' => 'Raffle',
            'title' => 'Raffle ' . Carbon::today()->toDateString(),
            'description' => 'Raffle ' . Carbon::today()->toDateString(),
            'subject' => 'Raffle Entries',
            'keywords' => 'name',
            'category' => 'Raffle Entries',
            'manager' => 'Raffle',
            'company' => 'Tarteeb',

        ];
    }
}
