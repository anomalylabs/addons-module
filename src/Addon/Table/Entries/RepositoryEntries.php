<?php namespace Anomaly\AddonsModule\Addon\Table\Entries;

use Anomaly\AddonsModule\Addon\Table\AddonTableBuilder;
use Anomaly\AddonsModule\Addon\Table\Command\FilterAddons;
use Anomaly\AddonsModule\Addon\Table\Command\GetRepositoryAddons;
use Anomaly\Streams\Platform\Support\Collection;
use Illuminate\Contracts\Config\Repository;
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
     * @param Repository        $config
     */
    public function handle(AddonTableBuilder $builder, Repository $config)
    {

        $addons = $this->dispatch(new GetRepositoryAddons($builder));

        foreach ($addons as &$addon) {

            list($vendor, $name) = explode('/', $addon['name']);
            list($title, $type) = explode('-', $name);

            $addon['type']   = $type;
            $addon['vendor'] = $vendor;

            $addon['title'] = ucwords(str_humanize($title));
        }

        $builder->setTableEntries(new Collection($addons));

        $this->dispatch(new FilterAddons($builder));
    }
}
