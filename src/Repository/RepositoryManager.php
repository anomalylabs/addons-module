<?php namespace Anomaly\AddonsModule\Repository;

use Anomaly\AddonsModule\Repository\Command\CacheRepository;
use Anomaly\AddonsModule\Repository\Contract\RepositoryInterface;

/**
 * Class RepositoryManager
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RepositoryManager
{

    /**
     * Cache a repository's packages.
     *
     * @param RepositoryInterface $repository
     */
    public function cache(RepositoryInterface $repository)
    {
        dispatch_now(new CacheRepository($repository));
    }

}
