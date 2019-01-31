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
        'addons',
        'repositories' => [
            'buttons' => [
                'add_repository',
                'sync_repositories' => [
                    'data-icon'    => 'info',
                    'button'       => 'export',
                    'data-toggle'  => 'process',
                    'data-message' => 'Updating Repositories',
                    'href'         => 'admin/addons/repositories/sync',
                    'text'         => 'anomaly.module.addons::button.sync_repositories',
                ],
            ],
        ],
    ];

}
