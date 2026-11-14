<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    // Mesure & tracking (audit SEO)
    'gtm_id' => env('GTM_ID'),
    'ga4_id' => env('GA4_ID'),
    'meta_pixel_id' => env('META_PIXEL_ID'),

    // Bouton WhatsApp (commandes & conseil)
    'whatsapp_number' => env('WHATSAPP_NUMBER', '2250799140356'),
    'whatsapp_message' => env('WHATSAPP_MESSAGE', 'Bonjour Mobilier Addict, je souhaite un conseil.'),

];
