<?php namespace Anomaly\AddonsModule\Addon\Table;

use Anomaly\Streams\Platform\Addon\AddonCollection;

/**
 * Class AddonTableEntries
 *
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 *
 * @link          http://pyrocms.com/
 */
class AddonTableEntries
{

    /**
     * Handle the command.
     *
     * @param AddonTableBuilder $builder
     * @param AddonCollection   $addons
     */
    public function handle(AddonTableBuilder $builder, AddonCollection $addons)
    {
        if (array_get($_GET, 'view') != 'packages')
        {
            $addons = $addons->{$builder->getType()}();

            $builder->setTableEntries($addons);
        }
    }
}
