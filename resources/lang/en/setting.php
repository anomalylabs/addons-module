<?php

return [
    'allow_update'   => [
        'name'         => 'Allow Updating',
        'instructions' => 'Allow updating addons within their constraints while in production mode?',
    ],
    'allow_download' => [
        'name'         => 'Allow Downloading',
        'instructions' => 'Allow downloading new addons while in production mode?',
        'warning'      => 'This may cause changes to <strong>composer.json</strong>',
    ],
    'allow_removal'  => [
        'name'         => 'Allow Removing',
        'instructions' => 'Allow removing addons while in production mode?',
        'warning'      => 'This may cause changes to <strong>composer.json</strong>',
    ],
];
