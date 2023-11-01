<?php

namespace App\Services;

use App\Mail\OrderConfirmation;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public static function sendOrderConfirmationMail(Order $order): bool
    {
        $mailTo = env('MAIL_TO_ADDRESS');
        if (Mail::to($mailTo)->send(new OrderConfirmation($order))) {
            Log::info("EmailService - sendOrderConfirmationMail: Confirmation email for order: $order->id successfully sent.");
            return true;
        }
        Log::error("EmailService - sendOrderConfirmationMail: Sending confirmation email for order: $order->id failed.");
        return false;
    }
}
