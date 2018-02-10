<?php

return [
    'allow_update'   => [
        'env'    => 'ADDONS_ALLOW_UPDATE',
        'type'   => 'anomaly.field_type.boolean',
        'bind'   => 'anomaly.module.addons::composer.allow_update',
        'config' => [
            'default_value' => true,
        ],
    ],
    'allow_download' => [
        'env'    => 'ADDONS_ALLOW_DOWNLOAD',
        'type'   => 'anomaly.field_type.boolean',
        'bind'   => 'anomaly.module.addons::composer.allow_download',
        'config' => [
            'default_value' => false,
        ],
    ],
    'allow_removal'  => [
        'env'    => 'ADDONS_ALLOW_REMOVAL',
        'type'   => 'anomaly.field_type.boolean',
        'bind'   => 'anomaly.module.addons::composer.allow_removal',
        'config' => [
            'default_value' => false,
        ],
    ],
];
