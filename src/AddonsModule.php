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
            'title'   => 'Modules',
            'badge'   => 3,
            'actions' => array(
                array(
                    'path'  => 'admin/addons/modules/create',
                    'title' => 'Add',
                )
            ),
        ),
        array(
            'path'  => 'admin/addons/themes',
            'title' => 'Themes',
        ),
        array(
            'path'  => 'admin/addons/tags',
            'title' => 'Tags',
        ),
        array(
            'path'  => 'admin/addons/field_types',
            'title' => 'Field Types',
        ),
        array(
            'path'  => 'admin/addons/blocks',
            'title' => 'Blocks',
        ),
        array(
            'path'  => 'admin/addons/extensions',
            'title' => 'Extensions',
        ),
    );

    /**
     * The icon to represent the module.
     *
     * @var string
     */
    public $icon = '<i class="fa fa-cubes"></i>';
}
