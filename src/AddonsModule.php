<?php namespace Anomaly\Streams\Addon\Module\Addons;

use Anomaly\Streams\Platform\Addon\Module\ModuleAddon;

class AddonsModule extends ModuleAddon
{
    protected $slug = 'addons';

    protected $nav = 'group.system';

    /**
     * The module menu.
     *
     * @var array
     */
    protected $menu = [
        [
            'title' => 'Settings',
            'url'   => 'admin/addons/settings',
        ],
        [
            'title' => 'Configuration',
            'url'   => 'admin/addons/configuration',
        ],
        [
            'title' => 'Drivers',
            'url'   => 'admin/addons/drivers',
        ]
    ];

    /**
     * ModuleAddon sections.
     *
     * @var array
     */
    protected $sections = array(
        array(
            'path'    => 'admin/addons/modules',
            'title'   => 'module::addon.section.modules',
            'badge'   => 3,
            'actions' => array(
                array(
                    'path'  => 'admin/addons/modules/create',
                    'title' => 'button.add',
                ),
            ),
        ),
        array(
            'path'  => 'admin/addons/themes',
            'title' => 'module::addon.section.themes',
        ),
        array(
            'path'  => 'admin/addons/tags',
            'title' => 'module::addon.section.tags',
        ),
        array(
            'path'  => 'admin/addons/field_types',
            'title' => 'module::addon.section.field_types',
        ),
        array(
            'path'  => 'admin/addons/blocks',
            'title' => 'module::addon.section.blocks',
        ),
        array(
            'path'  => 'admin/addons/extensions',
            'title' => 'module::addon.section.extensions',
        ),
    );
}
