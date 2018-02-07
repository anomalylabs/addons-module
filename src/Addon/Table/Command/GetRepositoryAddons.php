<?php namespace Anomaly\AddonsModule\Addon\Table\Command;

use Anomaly\AddonsModule\Addon\AddonNormalizer;
use Anomaly\AddonsModule\Addon\Table\AddonTableBuilder;
use Illuminate\Contracts\Config\Repository;

/**
 * Class GetRepositoryAddons
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetRepositoryAddons
{

    /**
     * The addon table builder.
     *
     * @var AddonTableBuilder
     */
    protected $builder;

    /**
     * Create a new GetRepositoryAddons instance.
     *
     * @param AddonTableBuilder $builder
     */
    public function __construct(AddonTableBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param Repository      $config
     * @param AddonNormalizer $normalizer
     * @return array
     */
    public function handle(Repository $config, AddonNormalizer $normalizer)
    {

        $view = $this->builder->getActiveTableView();

        $includes = array_keys(
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

        return $normalizer->normalize(
            array_filter(
                $packages,
                function ($package) {

                    return array_get($package, 'type') == 'streams-addon'
                        && str_is('*/*-' . str_singular($this->builder->getType()), $package['name']);
                }
            )
        );
    }
}
