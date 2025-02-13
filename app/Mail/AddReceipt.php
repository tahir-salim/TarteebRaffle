<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AddReceipt extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;
    public $totalAmount;
    public $entiesCount;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer, $totalAmount, $entiesCount)
    {
        $this->customer = $customer;
        $this->totalAmount = $totalAmount;
        $this->entiesCount = $entiesCount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Receipt Created Successfully')->markdown('emails.add-receipts');
    }
}
