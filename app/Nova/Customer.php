<?php

namespace App\Nova;

use App\Nova\Actions\ExportCustomers;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class Customer extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Customer::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
        'cpr',
        'phone',
        'email',
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
            ID::make()->sortable(),

            Text::make('Name')
                ->rules('required', 'string')
                ->sortable(),

            Text::make('CPR / Passport', 'cpr')
                ->rules('required', 'string')
                ->sortable(),

            Number::make('Phone')
                ->rules('required', 'integer')
                ->creationRules('unique:customers,phone')
                ->updateRules('unique:customers,phone,{{resourceId}}')
                ->help('Examnple: 973XXXXXXXX')
                ->sortable(),

            Text::make('Email')
                ->rules('nullable', 'email')
                ->sortable(),

            BelongsTo::make('Nationality', 'citizonship', Country::class),

            HasMany::make('Receipts', 'receipts', Receipt::class),

            HasMany::make('Raffle Entries', 'raffleEntries', RaffleEntry::class),

            // HasMany::make('Raffle Winners', 'winners', Raffle::class)



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

            ExportCustomers::make()
                ->standalone()
                ->onlyOnIndex()
                ->canSee(function ($request) {
                    return $request->user()->can('create', $this);
                })
        ];
    }
}
