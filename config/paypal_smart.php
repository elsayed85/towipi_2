<?php

return [
    'mode'    => env('PAYPAL_MODE', 'sandbox'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'client_id' =>env('PAYPAL_SANDBOX_API_CLIENT_ID'),
        'secret' => env('PAYPAL_SANDBOX_API_SECRET'),
    ],
    'live' => [
        'client_id' =>env('PAYPAL_LIVE_API_CLIENT_ID'),
        'secret' => env('PAYPAL_LIVE_API_SECRET'),
    ],

    'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => env("CURRENCY", "EGP"),
    'billing_type'   => 'MerchantInitiatedBilling',
    'notify_url'     => '', // Change this accordingly for your application.
    'locale'         => '', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => true, // Validate SSL when creating api client.
];
