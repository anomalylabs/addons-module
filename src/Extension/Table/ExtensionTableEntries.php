<?php namespace Anomaly\AddonsModule\Extension\Table;

use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;

/**
 * Class ExtensionTableEntries
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Extension\Table
 */
class ExtensionTableEntries
{

    /**
     * Handle the table entries.
     *
     * @param ExtensionTableBuilder $builder
     * @param ExtensionCollection   $themes
     */
    public function handle(ExtensionTableBuilder $builder, ExtensionCollection $themes)
    {
        $builder->setTableEntries($themes);
    }
}
