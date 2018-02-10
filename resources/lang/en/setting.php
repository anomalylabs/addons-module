<?php

return [
    'allow_updates'   => [
        'name'         => 'Allow Updates',
        'instructions' => 'Allow updating addons within their constraints while in production mode?',
    ],
    'allow_downloads' => [
        'name'         => 'Allow Downloads',
        'instructions' => 'Allow downloading new addons while in production mode?',
        'warning'      => 'This may cause changes to <strong>composer.json</strong>',
    ],
    'allow_removals'  => [
        'name'         => 'Allow Removals',
        'instructions' => 'Allow removing addons while in production mode?',
        'warning'      => 'This may cause changes to <strong>composer.json</strong>',
    ],
];
