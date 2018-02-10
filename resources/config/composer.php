<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Composer Restrictions
    |--------------------------------------------------------------------------
    |
    | These restrictions ONLY apply when `APP_ENV=production`
    |
    */
    'allow_updates'   => env('ADDONS_ALLOW_UPDATES', true),
    'allow_removals'  => env('ADDONS_ALLOW_REMOVALS', false),
    'allow_downloads' => env('ADDONS_ALLOW_DOWNLOADS', false),
];
