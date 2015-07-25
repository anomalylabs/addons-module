<?php namespace Anomaly\AddonsModule\Module\Table;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;

/**
 * Class ModuleTableEntries
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Module\Table
 */
class ModuleTableEntries
{

    /**
     * Handle the table entries.
     *
     * @param ModuleTableBuilder $builder
     * @param ModuleCollection   $modules
     */
    public function handle(ModuleTableBuilder $builder, ModuleCollection $modules)
    {
        if ($builder->isActiveView('all')) {
            $builder->setTableEntries($modules);
        }
    }
}
