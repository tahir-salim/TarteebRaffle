<?php

namespace App\Libraries;

use App\Models\SmsLog;
use Illuminate\Support\Facades\Log;
use Nexmo\Laravel\Facade\Nexmo;

class NexmoLibrary
{
    const FROM = 'ManamaGold';

    public static function sendMessage($phone, $text, $customerId = null)
    {
        try {

            $response = Nexmo::message()->send([
                'to' => $phone,
                'from' => self::FROM,
                'text' => $text,
            ]);

            $message = new SmsLog();
            $message->customer_id = $customerId;
            $message->phone = $phone;
            $message->message = $text;
            $message->nexmo_message_id = $response['messages'][0]['message-id'];
            $message->status = $response['messages'][0]['status'];
            $message->save();

            return $response;
        } catch (\Exception $ex) {
            Log::warning("sms error: "+$ex->getMessage());
            return $ex->getMessage();
        }
    }
}
