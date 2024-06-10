<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Create service checkout session and redirect to Stripe Payment Screen
     */
    public function checkoutService(ModelsRequest $request)
    {
        if (!$request->user->stripe_id) {
            $request->user->createAsStripeCustomer();
        }

        $customer = $request->user;

        $checkout_url = $customer
            ->allowPromotionCodes()
            ->checkoutCharge(
                $request->amount_due,
                $request->service->name,
                1,[
                    'success_url' => route('checkout.success').'?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => route('request.index'),
                    'metadata' => [
                        'app_purchase_type' => 'request',
                        'app_purchase_id' => $request->id,
                    ],
                    'customer' => $request->user->email
                ],
            );

        return $checkout_url;
    }

    /**
     * Create product checkout session and redirect to Stripe Payment Screen
     */
    public function checkoutProduct($product)
    {
        //
    }

    /**
     * Display a success message to the client
     */
    public function success(Request $request)
    {
        if (! $request->get('session_id')) {
            return redirect()->route('request.index');
        }
        $checkoutSession = $request->user()->stripe()->checkout->sessions->retrieve($request->get('session_id'));
        return view('checkout.success', ['checkoutSession' => $checkoutSession]);
    }
}
