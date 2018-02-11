<?php namespace Anomaly\AddonsModule\Addon\Command;

use Anomaly\AddonsModule\Addon\AddonReader;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class GetOutdatedAddons
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetOutdatedAddons
{

    use DispatchesJobs;

    /**
     * The addon type.
     *
     * @var string
     */
    protected $type;

    /**
     * Create a new GetOutdatedAddons instance.
     *
     * @param string $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Handle the command.
     *
     * @param AddonReader $reader
     * @param Repository  $cache
     * @return array
     */
    public function handle(AddonReader $reader, Repository $cache)
    {
        $addons = $cache->remember(
            'anomaly.module.addons::addons.all.' . $this->type,
            10,
            function () {
                return $this->dispatch(new GetAllAddons($this->type));
            }
        );

        $addons = $reader->read($addons);

        return array_filter(
            $addons,
            function (array $addon) {
                return array_get($addon, 'has_updates');
            }
        );
    }
}
