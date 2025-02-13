<?php

namespace App\Nova;

use App\Nova\Actions\ExportRaffleEntry;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;
use Titasgailius\SearchRelations\SearchesRelations;

class RaffleEntry extends Resource
{
    use SearchesRelations;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\RaffleEntry::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public function title()
    {
        return optional($this->raffle)->name . ' | ' . optional($this->customer)->name;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'total_amount', 'number_of_entries'
    ];

    public static $searchRelations = [
        'customer' => [
            'name',
            'cpr',
            'phone',
            'email',
        ],
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            // ID::make(__('ID'), 'id')->sortable(),

            BelongsTo::make('Customer', 'customer', Customer::class),

            BelongsTo::make('Raffle', 'raffle', Raffle::class),

            Number::make('Total Amount', 'total_amount')
                ->sortable(),

            Number::make('Number Of Entries', 'number_of_entries')
                ->sortable(),

            DateTime::make('Last Updated', 'updated_at')
                ->sortable(),

            BelongsToMany::make('Receipt', 'receipts', Receipt::class)->onlyOnDetail()

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            ExportRaffleEntry::make()
                ->standalone()
                ->onlyOnIndex()
        ];
    }
}
