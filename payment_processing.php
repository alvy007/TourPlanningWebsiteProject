<?php
// This file will interact with a payment gateway like Stripe, Bkash, Nogod, etc.
// Since it's backend, no HTML will be here. Just API integrations for processing.

function process_payment($payment_method, $payment_details) {
    if ($payment_method == 'card') {
        // Call to a payment gateway API (e.g., Stripe)
        // Example: $stripe_response = call_stripe_api($payment_details);
        return "Card payment successful!";
    } elseif ($payment_method == 'bikash' || $payment_method == 'nogod') {
        // Call to mobile payment API (e.g., Bkash API)
        return "Mobile payment via $payment_method successful!";
    }
}
?>
