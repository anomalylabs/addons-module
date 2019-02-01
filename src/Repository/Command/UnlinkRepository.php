<?php namespace Anomaly\AddonsModule\Repository\Command;

use Anomaly\AddonsModule\Repository\Contract\RepositoryInterface;
use Anomaly\Streams\Platform\Application\Application;

/**
 * Class UnlinkRepository
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class UnlinkRepository
{

    /**
     * The repository instance.
     *
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * Create a new UnlinkRepository instance.
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
        
        if (!file_exists($filename)) {
            return;
        }

        unlink($filename);
    }

}
