<?php namespace Anomaly\Streams\Addon\Module\Addons;

use Anomaly\Streams\Platform\Addon\Module\ModuleAddon;

class AddonsModule extends ModuleAddon
{
    protected $nav = 'group.system';

    protected $sections = array(
        array(
            'path'    => 'admin/addons/modules',
            'title'   => 'module::addon.section.modules',
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
