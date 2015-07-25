<?php namespace Anomaly\AddonsModule\Plugin\Table;

use Anomaly\Streams\Platform\Addon\Plugin\PluginCollection;

/**
 * Class PluginTableEntries
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Plugin\Table
 */
class PluginTableEntries
{

    /**
     * Handle the table entries.
     *
     * @param PluginTableBuilder $builder
     * @param PluginCollection   $plugins
     */
    public function handle(PluginTableBuilder $builder, PluginCollection $plugins)
    {
        $builder->setTableEntries($plugins);
    }
}
