<?php namespace Anomaly\AddonsModule\Addon\Table;

use Anomaly\AddonsModule\Addon\Table\Command\FetchAddons;
use Anomaly\AddonsModule\Addon\Table\Command\GetAddonData;
use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Illuminate\Foundation\Bus\DispatchesJobs;

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

    use DispatchesJobs;

    /**
     * Handle the command.
     *
     * @param AddonTableBuilder $builder
     * @param AddonCollection   $addons
     */
    public function handle(AddonTableBuilder $builder, AddonCollection $addons)
    {
        if (array_get($_GET, 'view') == 'github')
        {
            $items = new AddonCollection([]);
            $repos = $this->dispatch(new FetchAddons($addons));

            foreach ($repos as $repo)
            {
                $data = $this->dispatch(new GetAddonData($repo));

                if (!$addons->get(array_get($data, 'namespace'), false))
                {
                    $addon = (new Addon())
                    ->setVendor(array_get($data, 'vendor'))
                    ->setType(array_get($data, 'type'))
                    ->setSlug(array_get($data, 'slug'));

                    $items->put($addon->getNamespace(), $addon);
                }
            }

            $builder->setTableEntries($items);

            return;
        }

        $addons = $addons->{$builder->getType()}();

        $builder->setTableEntries($addons);
    }
}
