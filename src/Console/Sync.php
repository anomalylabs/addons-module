<?php namespace Anomaly\AddonsModule\Console;

use Anomaly\AddonsModule\Addon\Contract\AddonInterface;
use Anomaly\AddonsModule\Addon\Contract\AddonRepositoryInterface;
use Anomaly\AddonsModule\Repository\Command\GetRepositoryAddons;
use Anomaly\AddonsModule\Repository\Contract\RepositoryInterface;
use Anomaly\AddonsModule\Repository\Contract\RepositoryRepositoryInterface;
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
     * @param RepositoryRepositoryInterface $repositories
     * @param AddonRepositoryInterface      $addons
     */
    public function handle(RepositoryRepositoryInterface $repositories, AddonRepositoryInterface $addons)
    {
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

                /* @var AddonInterface $addon */
                if (!$addon = $addons->findByName($package['name'])) {

                    $addons->create($entry);

                    $this->info('Added: ' . $package['name']);

                    continue;
                }

                if ($entry['versions'] !== $addon->getVersions()) {

                    $addon->fill($entry);

                    $this->info('Synced: ' . $package['name']);

                    continue;
                }

                $this->info('Unchanged: ' . $package['name']);
            }
        }
    }

}
