<?php namespace Anomaly\AddonsModule\Addon;

use Anomaly\AddonsModule\Addon\Contract\AddonInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Class AddonCollection
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonCollection extends EntryCollection
{

    /**
     * Return only addons with updates.
     *
     * @return $this
     */
    public function updates()
    {
        return $this->filter(
            function ($addon) {

                /* @var AddonInterface $addon */
                return $addon->hasUpdates() ? $addon : null;
            }
        );
    }

    /**
     * Return only downloaded addons.
     *
     * @return static
     */
    public function downloaded()
    {
        return $this->filter(
            function ($addon) {

                /* @var AddonInterface $addon */
                return $addon->isDownloaded() ? $addon : null;
            }
        );
    }
}
