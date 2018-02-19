<?php namespace Anomaly\AddonsModule\Addon\Command;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\AddonCollection;
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
     * @param Cache           $cache
     * @param Config          $config
     * @param AddonCollection $collection
     * @return mixed
     * @internal param AddonReader $environment
     */
    public function handle(Cache $cache, Config $config, AddonCollection $collection)
    {

        return $cache->remember(
            'anomaly.module.addons::all.' . ($this->type ? '.' . $this->type : null),
            10,
            function () use ($collection, $config) {

                $addons = [];

                $repositories = array_keys($config->get('anomaly.module.addons::repository', []));

                foreach ($repositories as $repository) {
                    $addons = array_merge($addons, $this->dispatch(new GetRepositoryAddons($repository, $this->type)));
                }

                if ($this->type) {
                    $collection = $collection->{$this->type};
                }

                /* @var Addon $addon */
                foreach ($collection->nonCore() as $addon) {

                    $composer = $addon->getComposerJson();

                    $addons[$addon->getPackageName()] = [
                        'is_core'     => false,
                        'type'        => $addon->getType(),
                        'slug'        => $addon->getSlug(),
                        'title'       => $addon->getTitle(),
                        'vendor'      => $addon->getVendor(),
                        'id'          => $addon->getNamespace(),
                        'name'        => $addon->getPackageName(),
                        'description' => array_get($composer, 'description'),
                        'autoload'    => array_get($composer, 'autoload'),
                        'homepage'    => array_get($composer, 'homepage'),
                        'keywords'    => array_get($composer, 'keywords'),
                        'support'     => array_get($composer, 'support'),
                        'license'     => array_get($composer, 'license'),
                        'authors'     => array_get($composer, 'authors'),
                    ];
                }

                ksort($addons);

                return $addons;
            }
        );
    }
}
