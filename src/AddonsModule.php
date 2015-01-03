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
        'modules'    => [],
        'themes'     => [],
        'blocks'     => [],
        'tags'       => [],
        'extensions' => [],
    ];
}
