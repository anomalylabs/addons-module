<?php namespace Anomaly\AddonsModule\Addon\Table\Entries;

use Anomaly\AddonsModule\Addon\Table\AddonTableBuilder;
use Anomaly\AddonsModule\Addon\Table\Command\FilterAddons;
use Anomaly\AddonsModule\Addon\Table\Command\GetRepositoryAddons;
use Anomaly\AddonsModule\Addon\Table\Command\PaginateAddons;
use Anomaly\Streams\Platform\Support\Collection;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class RepositoryEntries
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RepositoryEntries
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
        $view = $builder->getActiveTableView();

        $addons = $cache->remember(
            'anomaly.module.addons::addons.' . $view->getSlug() . '.' . $builder->getType(),
            10,
            function () use ($builder) {
                return $addons = $this->dispatch(new GetRepositoryAddons($builder));;
            }
        );

        $builder->setTableEntries(new Collection($addons));

        $this->dispatch(new FilterAddons($builder));
        $this->dispatch(new PaginateAddons($builder));
    }
}
