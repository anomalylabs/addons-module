<?php namespace Anomaly\AddonsModule\Console;

use Anomaly\AddonsModule\Addon\Contract\AddonInterface;
use Anomaly\AddonsModule\Addon\Contract\AddonRepositoryInterface;
use Anomaly\AddonsModule\Repository\Command\CacheRepository;
use Anomaly\AddonsModule\Repository\Command\GetRepositoryAddons;
use Anomaly\AddonsModule\Repository\Contract\RepositoryInterface;
use Anomaly\AddonsModule\Repository\Contract\RepositoryRepositoryInterface;
use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Console\Command;

/**
 * Class Sync
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Sync extends Command
{

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'addons:sync';

    /**
     * Handle the command.
     *
     * @param Application $application
     * @param RepositoryRepositoryInterface $repositories
     * @param AddonRepositoryInterface $addons
     */
    public function handle(
        Application $application,
        RepositoryRepositoryInterface $repositories,
        AddonRepositoryInterface $addons
    ) {

        $log = $application->getAssetsPath('process.log');

        file_put_contents($log, '');

        sleep(1);

        /* @var RepositoryInterface $repository */
        foreach ($repositories->all() as $repository) {

            $this->info('Caching: ' . $repository->getUrl());

            file_put_contents($log, 'Downloading ' . $repository->getUrl());

            dispatch_now(new CacheRepository($repository));
        }

        file_put_contents($log, 'Updating Addons');

        /* @var RepositoryInterface $repository */
        foreach ($repositories->all() as $repository) {

            $packages = dispatch_now(new GetRepositoryAddons($repository));

            foreach ($packages as $package) {

                $entry = [
                    'namespace'   => array_get($package, 'id'),
                    'type'        => array_get($package, 'type'),
                    'name'        => array_get($package, 'name'),
                    'title'       => array_get($package, 'title'),
                    'homepage'    => array_get($package, 'homepage'),
                    'description' => array_get($package, 'description'),
                    'requires'    => array_get($package, 'require', []),
                    'versions'    => array_filter(
                        array_get($package, 'versions', []),
                        function ($version) {
                            return !str_contains($version, ['stable', 'RC', 'beta', 'alpha', 'dev']);
                        }
                    ),
                    'licenses'    => array_get($package, 'license', []),
                    'authors'     => array_get($package, 'authors', []),
                    'support'     => array_get($package, 'support', []),
                ];

                /* @var AddonInterface|EloquentModel $addon */
                if (!$addon = $addons->findByName($package['name'])) {

                    $addons->create($entry);

                    $this->info('Added: ' . $package['name']);

                    continue;
                }

                if ($entry['versions'] !== $addon->getVersions()) {

                    $addon->fill($entry);

                    $addons->save($addon);

                    $this->info('Synced: ' . $package['name']);

                    continue;
                }

                $this->info('Unchanged: ' . $package['name']);
            }
        }

        unlink($log);
    }

}
