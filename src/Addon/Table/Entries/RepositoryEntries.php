<?php namespace Anomaly\AddonsModule\Addon\Table\Entries;

use Anomaly\AddonsModule\Addon\Table\AddonTableBuilder;
use Anomaly\Streams\Platform\Support\Collection;
use Illuminate\Contracts\Config\Repository;

/**
 * Class RepositoryEntries
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RepositoryEntries
{

    /**
     * Handle the command.
     *
     * @param AddonTableBuilder $builder
     * @param Repository        $config
     */
    public function handle(AddonTableBuilder $builder, Repository $config)
    {

        $view = $builder->getActiveTableView();

        $builder->setTableOption('title', $config->get("anomaly.module.addons::repository.{$view->getSlug()}.title"));
        $builder->setTableOption(
            'description',
            $config->get("anomaly.module.addons::repository.{$view->getSlug()}.description")
        );

        $includes    = array_keys(
            json_decode(
                file_get_contents(
                    $config->get("anomaly.module.addons::repository.{$view->getSlug()}.url") . '/packages.json'
                ),
                true
            )['includes']
        );
        $includes[1] = $includes[0];

        array_walk(
            $includes,
            function (&$include) use ($config, $view) {
                $include = json_decode(
                    file_get_contents(
                        $config->get("anomaly.module.addons::repository.{$view->getSlug()}.url") . '/' . $include
                    ),
                    true
                )['packages'];
            }
        );

        $packages = [];

        array_map(
            function ($include) use (&$packages) {
                $packages = array_merge($packages, $include);
            },
            $includes
        );

        array_walk(
            $packages,
            function (&$versions) use (&$packages) {
                $versions = array_pop($versions);
            }
        );

        $addons = array_filter(
            $packages,
            function ($package) use ($builder) {

                return array_get($package, 'type') == 'streams-addon'
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
