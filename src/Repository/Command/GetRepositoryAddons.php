<?php namespace Anomaly\AddonsModule\Repository\Command;

use Anomaly\AddonsModule\Repository\Contract\RepositoryInterface;
use Anomaly\AddonsModule\Repository\RepositoryInput;
use Anomaly\Streams\Platform\Application\Application;

/**
 * Class GetRepositoryAddons
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetRepositoryAddons
{

    /**
     * The repository instance.
     *
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * Create a new GetRepositoryAddons instance.
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
        return json_decode(
            file_get_contents($application->getStoragePath('addons/' . md5($this->repository->getUrl()) . '.json')),
            true
        );
    }

}
