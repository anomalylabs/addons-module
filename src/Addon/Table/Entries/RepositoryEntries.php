<?php namespace Anomaly\AddonsModule\Addon\Table\Entries;

use Anomaly\AddonsModule\Addon\AddonReader;
use Anomaly\AddonsModule\Addon\Table\AddonTableBuilder;
use Anomaly\AddonsModule\Addon\Table\Command\FilterAddons;
use Anomaly\AddonsModule\Addon\Command\GetRepositoryAddons;
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
     * @param AddonReader       $reader
     * @param Repository        $cache
     */
    public function handle(AddonTableBuilder $builder, AddonReader $reader, Repository $cache)
    {
        $view = $builder->getActiveTableView();

        $addons = $cache->remember(
            'anomaly.module.addons::addons.' . $view->getSlug() . '.' . $builder->getType(),
            10,
            function () use ($builder, $view) {
                return $addons = $this->dispatch(
                    new GetRepositoryAddons(
                        $view->getSlug(),
                        $builder->getType()
                    )
                );
            }
        );

        $addons = $reader->read($addons);

        $builder->setTableEntries(new Collection($addons));

        $this->dispatch(new FilterAddons($builder));
        $this->dispatch(new PaginateAddons($builder));
    }
}
