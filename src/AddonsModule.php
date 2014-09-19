<?php namespace Streams\Addon\Module\Addons;

use Streams\Core\Addon\ModuleAbstract;

class AddonsModule extends ModuleAbstract
{
    /**
     * Module sections.
     *
     * @var array
     */
    public $sections = array(
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

    /**
     * The icon to represent the module.
     *
     * @var string
     */
    public $icon = '<i class="fa fa-cubes"></i>';
}
