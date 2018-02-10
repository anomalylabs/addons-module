<?php

return [
    'allow_downloads' => [
        'type'   => 'anomaly.field_type.boolean',
        'bind'   => 'anomaly.module.addons::config.allow_production_downloads',
        'config' => [
            'default_value' => false,
        ],
    ],
    'allow_updates'   => [
        'type'   => 'anomaly.field_type.boolean',
        'bind'   => 'anomaly.module.addons::config.allow_production_updates',
        'config' => [
            'default_value' => false,
        ],
    ],
    'allow_removals'  => [
        'type'   => 'anomaly.field_type.boolean',
        'bind'   => 'anomaly.module.addons::config.allow_removals',
        'config' => [
            'default_value' => false,
        ],
    ],
];
