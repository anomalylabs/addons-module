<?php namespace Anomaly\AddonsModule\Repository;

use Anomaly\AddonsModule\Repository\Command\DownloadRepository;
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

    public function download(RepositoryInterface $repository)
    {
        dispatch_now(new DownloadRepository($repository));
    }
}
