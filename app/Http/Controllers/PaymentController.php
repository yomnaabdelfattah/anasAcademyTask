<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        try {
            // Create a charge
            $charge = \Stripe\Charge::create([
                'amount' => 1000, // Amount in cents ($10.00)
                'currency' => 'usd',
                'source' => $request->input('stripeToken'), // Stripe token
                'description' => 'Test Payment',
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Payment successful!',
                'charge' => $charge,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    
}
