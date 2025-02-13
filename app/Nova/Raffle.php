<?php

namespace App\Nova;

use App\Nova\Actions\SelectWinner;
use App\Nova\Actions\UpdateEntries;
use App\Nova\Filters\DateFrom;
use App\Nova\Filters\DateTo;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;

class Raffle extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Raffle::class;

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
        'id', 'name'
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
            // ID::make()->sortable(),

            Text::make('Name')
                ->rules('required', 'string')
                ->sortable(),

            Date::make('Start date')
                ->rules('required')
                ->sortable(),

            Date::make('End date')
                ->rules('required')
                ->sortable(),

            DateTime::make('Created At')
                ->exceptOnForms()
                ->sortable(),

            // HasMany::make('Winners', 'raffleWinners', RaffleWinner::class),
            BelongsToMany::make('Winners', 'winners', Customer::class)
                ->fields(function () {
                    return [
                        DateTime::make('Created At')
                            ->sortable()
                            ->exceptOnForms(),
                    ];
                }),

            HasMany::make('Raffle Entry', 'raffleEntries', RaffleEntry::class)

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
        return [
            (new DateFrom('Started From', 'start_date')),
            (new DateTo('Ended to', 'end_date')),
        ];
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
            UpdateEntries::make(),
            SelectWinner::make()->onlyOnDetail()
        ];
    }
}
