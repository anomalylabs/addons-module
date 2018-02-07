<?php namespace Anomaly\AddonsModule\Addon\Table\Entries;

use Anomaly\AddonsModule\Addon\Table\AddonTableBuilder;
use Anomaly\AddonsModule\Addon\Table\Command\FilterAddons;
use Anomaly\AddonsModule\Addon\Table\Command\GetDownloadedAddons;
use Anomaly\Streams\Platform\Support\Collection;
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
     */
    public function handle(AddonTableBuilder $builder)
    {

        $addons = $this->dispatch(new GetDownloadedAddons($builder));

        $builder->setTableEntries(new Collection($addons));

        $this->dispatch(new FilterAddons($builder));
    }

}
