<?php namespace Anomaly\AddonsModule\Ui\Table\Module\Handler;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;

/**
 * Class EntriesHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Ui\Table\Module\Handler
 */
class EntriesHandler
{

    /**
     * Handle the table entries.
     *
     * @param ModuleCollection $modules
     * @return static
     */
    public function handle(ModuleCollection $modules)
    {
        return $modules->orderByName();
    }
}
