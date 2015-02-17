<?php namespace Anomaly\AddonsModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class AddonsModule
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule
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
        'modules',
        'themes',
        'blocks',
        'plugins',
        'extensions',
        'field_types',
        'distributions',
    ];

    /**
     * The module modals.
     *
     * @var array
     */
    protected $modals = [
        'module::admin/modals/test',
        [
            'title'   => 'My generic modal',
            'content' => 'Some\Handler\Class'
        ]
    ];

}
