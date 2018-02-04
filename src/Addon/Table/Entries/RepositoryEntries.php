<?php namespace Anomaly\AddonsModule\Addon\Table\Entries;

use Anomaly\AddonsModule\Addon\Table\AddonTableBuilder;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Support\Collection;

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
     * @param AddonCollection   $addons
     */
    public function handle(AddonTableBuilder $builder)
    {
        $view = $builder->getActiveTableView();

        $repository = array_filter(
            json_decode(file_get_contents(base_path('composer.json')), true)['repositories'],
            function ($repository) use ($view) {
                return md5($repository['url']) == $view->getSlug();
            }
        );

        $repository = array_shift($repository);

        $includes    = array_keys(
            json_decode(file_get_contents($repository['url'] . '/packages.json'), true)['includes']
        );
        $includes[1] = $includes[0];

        array_walk(
            $includes,
            function (&$include) use ($repository) {
                $include = json_decode(file_get_contents($repository['url'] . '/' . $include), true)['packages'];
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
