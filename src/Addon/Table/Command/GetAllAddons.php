<?php namespace Anomaly\AddonsModule\Addon\Table\Command;

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;

class GetAllAddons
{

    use DispatchesJobs;

    /**
     * The repository to fetch.
     *
     * @var string
     */
    protected $repository;

    /**
     * Create a new GetAllAddons instance.
     *
     * @param string $repository
     */
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function handle(Repository $cache)
    {
        if ($this->repository == 'downloaded') {
            return $cache->remember(
                'anomaly.module.addons::addons.' . $this->repository,
                10,
                function () {
                    return $this->dispatch(new GetDownloadedAddons());
                }
            );
        }

        return $cache->remember(
            'anomaly.module.addons::addons.' . $this->repository,
            10,
            function () {
                return $this->dispatch(new GetRepositoryAddons($this->repository));
            }
        );
    }

}
