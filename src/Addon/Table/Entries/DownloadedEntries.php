<?php namespace Anomaly\AddonsModule\Addon\Table\Entries;

use Anomaly\AddonsModule\Addon\Table\AddonTableBuilder;
use Anomaly\AddonsModule\Addon\Table\Command\FilterAddons;
use Anomaly\AddonsModule\Addon\Table\Command\GetDownloadedAddons;
use Anomaly\AddonsModule\Addon\Table\Command\PaginateAddons;
use Anomaly\Streams\Platform\Support\Collection;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DownloadedEntries
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DownloadedEntries
{

    use DispatchesJobs;

    /**
     * Handle the command.
     *
     * @param AddonTableBuilder $builder
     * @param Repository        $cache
     */
    public function handle(AddonTableBuilder $builder, Repository $cache)
    {

        $addons = $cache->remember(
            'anomaly.module.addons::addons.downloaded.' . $builder->getType(),
            10,
            function () use ($builder) {
                return $this->dispatch(new GetDownloadedAddons($builder->getType()));
            }
        );

        $builder->setTableEntries(new Collection($addons));

        $this->dispatch(new FilterAddons($builder));
        $this->dispatch(new PaginateAddons($builder));
    }

}
