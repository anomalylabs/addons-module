<?php namespace Anomaly\AddonsModule\Repository\Command;

use Anomaly\AddonsModule\Repository\Contract\RepositoryInterface;
use Anomaly\Streams\Platform\Application\Application;

/**
 * Class CheckRepository
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CheckRepository
{

    /**
     * The repository instance.
     *
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * Create a new CheckRepository instance.
     *
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle the command.
     *
     * @param Application $application
     */
    public function handle(Application $application)
    {
        $filename = $application->getStoragePath('addons/' . md5($this->repository->getUrl()) . '.json');

        /**
         * If we don't have a cache file
         * or it's older than 1 day then
         * we should prompt for updating.
         */
        if (!file_exists($filename) || time() - filemtime($filename) > (60 * 60)) {
            return true;
        }

        return false;
    }

}
