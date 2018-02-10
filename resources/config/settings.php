<?php

return [
    'allow_updates'   => [
        'env'    => 'ADDONS_ALLOW_UPDATES',
        'type'   => 'anomaly.field_type.boolean',
        'bind'   => 'anomaly.module.addons::composer.allow_updates',
        'config' => [
            'default_value' => true,
        ],
    ],
    'allow_downloads' => [
        'env'    => 'ADDONS_ALLOW_DOWNLOADS',
        'type'   => 'anomaly.field_type.boolean',
        'bind'   => 'anomaly.module.addons::composer.allow_downloads',
        'config' => [
            'default_value' => false,
        ],
    ],
    'allow_removals'  => [
        'env'    => 'ADDONS_ALLOW_REMOVALS',
        'type'   => 'anomaly.field_type.boolean',
        'bind'   => 'anomaly.module.addons::composer.allow_removals',
        'config' => [
            'default_value' => false,
        ],
    ],
];
