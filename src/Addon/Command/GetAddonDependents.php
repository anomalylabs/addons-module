<?php namespace Anomaly\AddonsModule\Addon\Command;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\AddonCollection;

/**
 * Class GetAddonDependents
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetAddonDependents
{

    /**
     * The addon details.
     *
     * @var array
     */
    protected $addon;

    /**
     * The lock file details.
     *
     * @var array
     */
    protected $lock;

    /**
     * Create a new GetAddonDependents instance.
     *
     * @param array $addon
     * @param array $lock
     */
    public function __construct(array $addon, array $lock)
    {
        $this->addon = $addon;
        $this->lock  = $lock;
    }

    public function handle(AddonCollection $addons)
    {
        $addons = $addons->filter(
            function (Addon $addon) {

                $lock = $addon->getComposerLock();

                if (!isset($lock['require'])) {
                    return false;
                }

                return isset($lock['require'][$this->addon['name']]);
            }
        );

        return $addons->map(
            function (Addon $addon) {
                return "{$addon->getVendor()}/{$addon->getSlug()}-{$addon->getType()}";
            }
        )->values()->all();
    }
}
