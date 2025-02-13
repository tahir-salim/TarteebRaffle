<?php

namespace App\Exports;

use App\Models\Customer;
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

class CustomersExport implements FromCollection, WithProperties, WithTitle, WithMapping, WithHeadings, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    use Exportable;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $customers = [];

    public function __construct($customers)
    {
        $this->customers = $customers;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Customers';
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->customers;
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
    public function map($customers): array
    {
        $fields = [

            $customers->name,
            $customers->cpr,
            $customers->phone ? $customers->phone : null,
            $customers->email,
            $customers->country_id ? optional($customers->country)->name : $customers->country_id,
            $customers->created_at,

        ];

        return $fields;
    }

    public function headings(): array
    {
        return [

            'Name',
            'Cpr/Passport',
            'Phone',
            'Email',
            'Country',
            'Created at'
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
            'subject' => 'Customers',
            'keywords' => 'name',
            'category' => 'customers',
            'manager' => 'Raffle',
            'company' => 'Raffle',

        ];
    }
}
