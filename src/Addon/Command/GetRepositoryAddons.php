<?php namespace Anomaly\AddonsModule\Addon\Command;

use Anomaly\AddonsModule\Addon\AddonNormalizer;
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
     * The repository slug.
     *
     * @var string
     */
    protected $repository;

    /**
     * The type of addons to return.
     *
     * @var string
     */
    protected $type;

    /**
     * Create a new GetRepositoryAddons instance.
     *
     * @param string $repository
     * @param null   $type
     */
    public function __construct($repository, $type = null)
    {
        $this->type       = $type;
        $this->repository = $repository;
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

        $includes = array_keys(
            json_decode(
                file_get_contents(
                    $config->get("anomaly.module.addons::repository.{$this->repository}.url") . '/packages.json'
                ),
                true
            )['includes']
        );

        $packages = [];

        array_walk(
            $includes,
            function (&$include) use (&$packages, $config) {

                $include = json_decode(
                    file_get_contents(
                        $config->get("anomaly.module.addons::repository.{$this->repository}.url") . '/' . $include
                    ),
                    true
                )['packages'];

                $packages = array_merge($packages, $include);
            }
        );

        array_walk(
            $packages,
            function (&$availability) {

                $versions = $availability;

                $latest = array_pop($availability);

                $availability = $latest;

                unset($availability['version']);

                $availability['versions'] = array_keys($versions);
            }
        );

        return $normalizer->normalize(
            array_filter(
                $packages,
                function ($package) {

                    if (array_get($package, 'type') != 'streams-addon') {
                        return false;
                    }

                    if (!$this->type) {
                        return true;
                    }

                    return str_is('*/*-' . str_singular($this->type), $package['name']);
                }
            )
        );
    }
}
