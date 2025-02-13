<?php

namespace App\Nova\Actions;

use App\Exports\RaffleEntryExport;
use App\Models\RaffleEntry;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\URL;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportRaffleEntry extends Action
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
        $raffleEntries = [];

        $raffleEntries = RaffleEntry::with(['customer','raffle'])->get();

        if (!count($raffleEntries)) {
            return Action::danger('No Raffle Entries found');
        }

        $response = Excel::download(
            new RaffleEntryExport($raffleEntries),
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
        return 'Raffle Entries ' . Carbon::today()->toDateString() . ".xlsx";
    }
}
