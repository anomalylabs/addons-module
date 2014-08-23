<?php namespace Streams\Addon\Module\Addons\Installer;

use Streams\Core\Addon\Installer\ModuleInstallerAbstractAbstract;

class AddonsModuleInstallerAbstract extends ModuleInstallerAbstractAbstract
{
    /**
     * The stream fields definitions.
     *
     * @var array
     */
    protected $fields = [
        'slug'         => [
            'type' => 'text',
        ],
        'is_installed' => [
            'type'     => 'boolean',
            'settings' => [
                'default_value' => '0',
            ],
        ],
        'is_enabled'   => [
            'type'     => 'boolean',
            'settings' => [
                'default_value' => '0',
            ],
        ],
    ];
}