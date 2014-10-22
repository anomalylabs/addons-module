<?php namespace Anomaly\Streams\Addon\Module\Addons\Installer;

use Anomaly\Streams\Platform\Field\FieldInstaller;

class AddonsFieldInstaller extends FieldInstaller
{
    protected $namespace = 'addons';

    protected $fields = [
        'slug' => [
            'type' => 'slug',
        ]
    ];
}
 