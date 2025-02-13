<?php

namespace App\Nova\Metrics;

use App\Models\Receipt;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class ReceiptsPerLocation extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $data = Receipt::withCount('customer')
            ->whereNull('deleted_at')
            ->get()
            ->toArray();

        return $this->result(array_combine(array_column($data,'receipt_number'), array_column($data, 'customer_count')));
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
        return 'receipts-per-location';
    }
}
