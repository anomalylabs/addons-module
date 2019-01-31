<?php namespace Anomaly\AddonsModule\Console;

use Anomaly\AddonsModule\Addon\Contract\AddonInterface;
use Anomaly\AddonsModule\Addon\Contract\AddonRepositoryInterface;
use Anomaly\AddonsModule\Repository\Command\CacheRepository;
use Anomaly\AddonsModule\Repository\Command\GetRepositoryAddons;
use Anomaly\AddonsModule\Repository\Contract\RepositoryInterface;
use Anomaly\AddonsModule\Repository\Contract\RepositoryRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\Command\GetAddon;
use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

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

        $manifest = [];

        $log = $application->getAssetsPath('process.log');

        file_put_contents($log, '');

        sleep(2);

        /* @var RepositoryInterface $repository */
        foreach ($repositories->all() as $repository) {

            $this->info('Caching: ' . $repository->getUrl());

            file_put_contents($log, 'Downloading ' . $repository->getUrl());

            dispatch_now(new CacheRepository($repository));
        }

        /* @var RepositoryInterface $repository */
        foreach ($repositories->all() as $repository) {

            $packages = dispatch_now(new GetRepositoryAddons($repository));

            foreach ($packages as $package) {

                $manifest[] = array_get($package, 'name');

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

                    $this->info('Adding: ' . $package['name']);

                    file_put_contents($log, 'Adding: ' . $package['name']);

                    $entry['assets']      = $this->assets($package);
                    $entry['readme']      = $this->readme($package);
                    $entry['marketplace'] = $this->marketplace($package);

                    $addons->create($entry);

                    continue;
                }

                if ($entry['versions'] !== $addon->getVersions() || $this->option('force')) {

                    $this->info('Syncing: ' . $package['name']);

                    file_put_contents($log, 'Syncing: ' . $package['name']);

                    $entry['assets']      = $this->assets($package);
                    $entry['readme']      = $this->readme($package);
                    $entry['marketplace'] = $this->marketplace($package);

                    $addon->fill($entry);

                    $addons->save($addon);

                    continue;
                }

                $this->info('Unchanged: ' . $package['name']);

                file_put_contents($log, 'Unchanged: ' . $package['name']);
            }
        }

        foreach ($addons->except($manifest) as $addon) {

            $this->info('Removing: ' . $addon->getName());

            file_put_contents($log, 'Removing: ' . $addon->getName());

            $addons->delete($addon);
        }

        unlink($log);
    }

    /**
     * Return addon assets.
     *
     * @param array $package
     * @return array
     */
    protected function assets(array $package)
    {
        try {

            $composer = file_get_contents(
                'https://assets.pyrocms.com/'
                . str_replace(['/', '_'], '-', array_get($package, 'name'))
                . '-composer.json'
            );

            return array_get((array)json_decode($composer, true), 'assets', []);

        } catch (\Exception $exception) {
            return [];
        }
    }

    /**
     * Return addon readme.
     *
     * @param array $package
     * @return string
     */
    protected function readme(array $package)
    {
        try {

            /* @var Addon $addon */
            if ($addon = dispatch_now(new GetAddon(array_get($package, 'id')))) {
                return $addon->getReadme();
            }

            return file_get_contents(
                'https://assets.pyrocms.com/'
                . str_replace(['/', '_'], '-', array_get($package, 'name'))
                . '-readme.md'
            );
        } catch (\Exception $exception) {
            return null;
        }
    }

    /**
     * Return marketplace information.
     *
     * @param array $package
     * @return array
     */
    protected function marketplace(array $package)
    {
        try {

            $composer = file_get_contents(
                'https://assets.pyrocms.com/'
                . str_replace(['/', '_'], '-', array_get($package, 'name'))
                . '-marketplace.json'
            );

            return array_get((array)json_decode($composer, true), 'assets', []);

        } catch (\Exception $exception) {
            return [];
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force updates for addons.'],
        ];
    }

}
