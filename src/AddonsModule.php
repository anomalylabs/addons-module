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
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'modules'     => [
            'matcher' => 'admin/addons',
            'href'    => 'admin/addons?view={request.input.view}',
        ],
        'themes'      => [
            'matcher' => 'admin/addons/themes',
            'href'    => 'admin/addons/themes?view={request.input.view}',
        ],
        'plugins'     => [
            'matcher' => 'admin/addons/plugins',
            'href'    => 'admin/addons/plugins?view={request.input.view}',
        ],
        'extensions'  => [
            'matcher' => 'admin/addons/extensions',
            'href'    => 'admin/addons/extensions?view={request.input.view}',
        ],
        'field_types' => [
            'matcher' => 'admin/addons/field_types',
            'href'    => 'admin/addons/field_types?view={request.input.view}',
        ],
    ];

}
