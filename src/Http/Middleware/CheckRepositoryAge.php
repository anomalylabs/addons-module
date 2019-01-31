<?php namespace Anomaly\AddonsModule\Http\Middleware;

use Anomaly\AddonsModule\Repository\Contract\RepositoryInterface;
use Anomaly\AddonsModule\Repository\Contract\RepositoryRepositoryInterface;
use Anomaly\AddonsModule\Repository\RepositoryManager;
use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Asset\Asset;
use Closure;
use Illuminate\Http\Request;

/**
 * Class CheckRepositoryAge
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CheckRepositoryAge
{

    /**
     * The asset manager.
     *
     * @var Asset
     */
    protected $asset;

    /**
     * The repository manager.
     *
     * @var RepositoryManager
     */
    protected $manager;

    /**
     * The repositories repository.
     *
     * @var RepositoryRepositoryInterface
     */
    protected $repositories;

    /**
     * Create a new CheckRepositoryAge instance.
     *
     * @param Asset $asset
     * @param Application $application
     * @param RepositoryManager $manager
     * @param RepositoryRepositoryInterface $repositories
     */
    public function __construct(
        Asset $asset,
        RepositoryManager $manager,
        RepositoryRepositoryInterface $repositories
    ) {
        $this->asset        = $asset;
        $this->manager      = $manager;
        $this->repositories = $repositories;
    }

    /**
     * Check for and set namespace if present.
     *
     * @param  Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /* @var RepositoryInterface $repository */
        foreach ($this->repositories->all() as $repository) {

            if ($this->manager->outdated($repository)) {

                $this->asset->add('scripts.js', 'anomaly.module.addons::js/update.js');

                return $next($request);
            }
        }

        return $next($request);
    }
}
