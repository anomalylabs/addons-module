<?php namespace Anomaly\AddonsModule\Addon\Table\Entries;

use Anomaly\AddonsModule\Addon\Table\AddonTableBuilder;
use Anomaly\Streams\Platform\Support\Collection;

/**
 * Class DownloadedEntries
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DownloadedEntries
{

    /**
     * Handle the command.
     *
     * @param AddonTableBuilder $builder
     */
    public function handle(AddonTableBuilder $builder)
    {
        $builder->setTableOption('title', "anomaly.module.addons::section.{$builder->getType()}.title");
        $builder->setTableOption('description', "anomaly.module.addons::section.{$builder->getType()}.description");

        $addons = array_filter(
            json_decode(file_get_contents(base_path('composer.lock')), true)['packages'],
            function ($package) use ($builder) {
                return $package['type'] == 'streams-addon'
                    && str_is('*/*-' . str_singular($builder->getType()), $package['name']);
            }
        );

        foreach ($addons as &$addon) {

            list($vendor, $name) = explode('/', $addon['name']);
            list($title, $type) = explode('-', $name);

            $addon['type']   = $type;
            $addon['vendor'] = $vendor;

            $addon['title'] = ucwords(str_humanize($title));
        }

        $builder->setTableEntries(new Collection($addons));
    }
}
