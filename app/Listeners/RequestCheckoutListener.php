<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Request;
use App\Models\Scopes\RequestScope;
use App\Notifications\RequestReceived;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Laravel\Cashier\Events\WebhookReceived;

class RequestCheckoutListener
{
    /**
     * Create the event listener.
     */
    public function __construct(){}

    /**
     * Handle the event.
     */
    public function handle(WebhookReceived $event): void
    {
        try {
            if ($event->payload['type'] === 'checkout.session.completed') {
                $data = $event->payload['data']['object'];
                $payment_status = $data['payment_status'];
                $transaction_status = $data['status'];
                $app_purchase_type = $data['metadata']['app_purchase_type'];
                $app_purchase_id = $data['metadata']['app_purchase_id'];
                $payment_intent = $data['payment_intent'];

                Log::info('Payment details', [
                    'payment_status' => $payment_status,
                    'transaction_status' => $transaction_status,
                    'app_purchase_type' => $app_purchase_type,
                    'app_purchase_id' => $app_purchase_id,
                    'payment_intent' => $payment_intent
                ]);

                if ($app_purchase_type == 'request' && $payment_status == 'paid' && $transaction_status == 'complete') {
                    $request = Request::withoutGlobalScope(RequestScope::class)->findOrFail($app_purchase_id);
                    $request->update([
                        'stripe_payment_id' => $payment_intent,
                        'paid_at' => now(),
                    ]);
                    Log::info('Request updated', ['request' => $request]);

                    // Dispatch a notification to Staff to Start working on Request
                    $staff = User::where('is_client', 0)->get();
                    Notification::send($staff, new RequestReceived($request));

                    Log::info('Notification sent to staff', ['staff' => $staff]);
                }
            }
        } catch (\Throwable $th) {
            Log::error('Error handling webhook', ['error' => $th]);
        }
    }
}
