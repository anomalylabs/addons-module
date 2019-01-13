<?php namespace Anomaly\AddonsModule\Addon\Contract;

use Anomaly\AddonsModule\Addon\AddonCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface AddonRepositoryInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface AddonRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find an addon by it's name.
     *
     * @param $name
     * @return AddonInterface|null
     */
    public function findByName($name);

    /**
     * Find an addon by it's namespace.
     *
     * @param $namespace
     * @return AddonInterface|null
     */
    public function findByNamespace($namespace);

    /**
     * Return all downloaded addons.
     *
     * @return AddonCollection
     */
    public function downloaded();

}
