<?php namespace Anomaly\AddonsModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class AddonsModule
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddonsModule extends Module
{

    /**
     * The module navigation group.
     *
     * @var string
     */
    protected $navigation = 'streams::navigation.system';

    /**
     * The addon sections.
     *
     * @var array
     */
    protected $sections = [
        'addons' => [
            'buttons' => [
                'update' => [
                    'data-icon'    => 'info',
                    'data-toggle'  => 'process',
                    'class'        => 'btn btn-danger',
                    'href'         => 'admin/addons/repositories/update',
                    'data-message' => 'Updating Repositories',
                ],
            ],
        ],
        'repositories',
    ];

}
