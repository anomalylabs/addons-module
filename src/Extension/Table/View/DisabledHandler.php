<?php namespace Anomaly\AddonsModule\Extension\Table\View;

use Anomaly\AddonsModule\Extension\Table\ExtensionTableBuilder;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;

/**
 * Class DisabledHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Extension\Table\View
 */
class DisabledHandler
{

    /**
     * Handle the view.
     *
     * @param ExtensionTableBuilder $builder
     * @param ExtensionCollection   $extensions
     */
    public function handle(ExtensionTableBuilder $builder, ExtensionCollection $extensions)
    {
        $builder->setTableEntries($extensions->installed()->disabled());
    }
}
