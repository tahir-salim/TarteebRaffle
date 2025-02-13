<?php

namespace App\Nova;

use App\Nova\Actions\CreateReceipt;
use App\Nova\Filters\DateFrom;
use App\Nova\Filters\DateTo;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\DateTime;
use Titasgailius\SearchRelations\SearchesRelations;


class Receipt extends Resource
{
    use SearchesRelations;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Receipt::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'receipt_number';

    public function title()
    {
        return $this->receipt_number . ' | ' . optional($this->shop)->name;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'receipt_number',
        'amount'
    ];

    public static $searchRelations = [
        'customer' => [
            'name',
            'cpr',
            'phone',
            'email',
        ],
        'shop' => ['name'],
        'createdBy' => ['name']
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
            // Text::make('', function () {
            //     $url = config('app.url');
            //     // $testId = $this->id;
            //     return "<div class='edit-button-main' style='display: flex;align-items: center;justify-content: flex-end;color: #b3b9bf;'><a style='color:#b3b9bf;' href='{$url}/receipt-form/' class='product-edit-button'><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" viewBox=\"0 0 20 20\" aria-labelledby=\"edit\" role=\"presentation\" class=\"fill-current\"><path d=\"M4.3 10.3l10-10a1 1 0 0 1 1.4 0l4 4a1 1 0 0 1 0 1.4l-10 10a1 1 0 0 1-.7.3H5a1 1 0 0 1-1-1v-4a1 1 0 0 1 .3-.7zM6 14h2.59l9-9L15 2.41l-9 9V14zm10-2a1 1 0 0 1 2 0v6a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h6a1 1 0 1 1 0 2H2v14h14v-6z\"></path></svg></a></div>";
            // })->asHtml()->onlyOnIndex(),

            Text::make('Receipt number')
                ->rules('required', 'string')
                ->sortable(),

            BelongsTo::make('Shop', 'shop', Shop::class),

            BelongsTo::make('Customer', 'customer', Customer::class),

            Date::make('Purchase date')
                ->rules('required')
                ->sortable(),

            Number::make('Amount')
                ->rules('required', 'numeric')
                ->sortable(),

            BelongsTo::make('Created by', 'createdBy', User::class),

            DateTime::make('Created At')->onlyOnDetail(),

            DateTime::make('Last Updated At', 'updated_at')
                ->onlyOnDetail(),

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
            (new DateFrom('Purchased From', 'purchase_date')),
            (new DateTo('Purchased To', 'purchase_date')),
            (new DateFrom('Created From', 'created_at')),
            (new DateTo('Created To', 'created_at')),
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
            // CreateReceipt::make()->standalone()->withoutConfirmation(),
        ];
    }
}
