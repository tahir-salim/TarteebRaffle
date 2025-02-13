<?php

namespace App\Nova\Metrics;

use App\Models\Receipt;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class ReceiptsPerUser extends Partition
{

    public $name = 'Receipts Per Customer';

    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $data = Receipt::select('customer_id', DB::raw('count(*) as total'))
            ->with('customer:name,id')
            ->groupBy('customer_id')
            ->get()
            ->toArray();

        return $this->result(array_combine(array_map(function ($x) {
            return isset($x['customer']['name']) ? $x['customer']['name'] : null;
        }, $data), array_column($data, 'total')));
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'receipts-per-user';
    }
}
