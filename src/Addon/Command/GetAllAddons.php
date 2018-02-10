<?php namespace Anomaly\AddonsModule\Addon\Command;

use Anomaly\AddonsModule\Addon\AddonReader;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class GetAllAddons
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetAllAddons
{

    use DispatchesJobs;

    /**
     * The addon type.
     *
     * @var null|string
     */
    protected $type;

    /**
     * Create a new GetAllAddons instance.
     *
     * @param null|string $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Handle the command.
     *
     * @param Cache       $cache
     * @param Config      $config
     * @param AddonReader $environment
     */
    public function handle(Cache $cache, Config $config)
    {

        return $cache->remember(
            'anomaly.module.addons::all.' . ($this->type ? '.' . $this->type : null),
            10,
            function () use ($config) {

                $addons = [];

                $repositories = array_keys($config->get('anomaly.module.addons::repository', []));

                foreach ($repositories as $repository) {
                    $addons = array_merge($addons, $this->dispatch(new GetRepositoryAddons($repository, $this->type)));
                }

                return $addons;
            }
        );
    }
}
