<?php namespace Anomaly\AddonsModule\Addon\Table;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class AddonTableEntries
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Addon\Table
 */
class AddonTableEntries implements SelfHandling
{

    /**
     * Handle the command.
     *
     * @param AddonTableBuilder $builder
     * @param AddonCollection   $addons
     */
    public function handle(AddonTableBuilder $builder, AddonCollection $addons)
    {
        $addons = $addons->{$builder->getType()}();

        $builder->setTableEntries($addons);
    }
}
