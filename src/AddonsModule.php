<?php namespace Anomaly\Streams\Addon\Module\Addons;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class AddonsModule
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Module\Addons
 */
class AddonsModule extends Module
{

    /**
     * The module navigation group.
     *
     * @var string
     */
    protected $navigation = 'navigation.system';

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
