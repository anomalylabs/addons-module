<?php namespace Anomaly\Streams\Addon\Module\Addons\Installer;

use Anomaly\Streams\Platform\Stream\StreamInstaller;

class ModulesStreamInstaller extends StreamInstaller
{
    protected $stream = [
        'slug'      => 'modules',
        'namespace' => 'addons',
    ];

    protected $assignments = [
        [
            'field' => 'slug',
        ]
    ];
}
 