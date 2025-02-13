<?php

namespace App\Nova\Actions;

use App\Exports\CustomersExport;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportCustomers extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $customers = [];

        if (request()->viaResource == "raffles" && request()->viaRelationship == "winners" && request()->viaResourceId) {
            $customers = Customer::whereHas('winners', function ($query) {
                $query->where('raffle_id', request()->viaResourceId);
            })->get();
        } else {
            $customers = Customer::with('country')->whereNull('deleted_at')->get();
        }

        if (!count($customers)) {
            return Action::danger('No Customers found');
        }

        $response = Excel::download(
            new CustomersExport($customers),
            $this->getFilename()
        );

        if (!$response instanceof BinaryFileResponse || $response->isInvalid()) {
            return Action::danger(__('Resource could not be exported.'));
        }

        return Action::download(
            $this->getDownloadUrl($response),
            $this->getFilename()
        );
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

    /**
     * @param BinaryFileResponse $response
     *
     * @return string
     */
    protected function getDownloadUrl(BinaryFileResponse $response): string
    {
        return URL::temporarySignedRoute('laravel-nova-excel.download', now()->addMinutes(1), [
            'path' => encrypt($response->getFile()->getPathname()),
            'filename' => $this->getFilename(),
        ]);
    }

    /**
     * @return string|null
     */
    protected function getFilename(): ?string
    {
        $prefix = '';
        if (strpos(URL::full(), 'viaRelationship=winners') !== false) {
            $prefix = 'Winner ';
        }
        return $prefix . 'Customers ' . Carbon::today()->toDateString() . ".xlsx";
    }
}
