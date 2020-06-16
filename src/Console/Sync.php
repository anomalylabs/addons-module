<?php namespace Anomaly\AddonsModule\Console;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\Command\GetAddon;
use Anomaly\Streams\Platform\Application\Application;
use Anomaly\AddonsModule\Repository\Command\CacheRepository;
use Anomaly\AddonsModule\Repository\Command\GetRepositoryAddons;
use Anomaly\AddonsModule\Addon\Contract\AddonRepositoryInterface;
use Anomaly\AddonsModule\Repository\Contract\RepositoryRepositoryInterface;

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
     * @param AddonCollection $collection
     */
    public function handle(
        Application $application,
        RepositoryRepositoryInterface $repositories,
        AddonRepositoryInterface $addons,
        AddonCollection $collection
    ) {

        $manifest = [];

        if (! is_dir($application->getAssetsPath())) {
            mkdir($application->getAssetsPath());
        }

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
                    'suggests'    => array_get($package, 'suggest', []),
                    'versions'    => array_filter(
                        array_get($package, 'versions', []),
                        function ($version) {
                            return !Str::contains($version, ['stable', 'RC', 'beta', 'alpha', 'dev']);
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

            /* @var Addon $instance */
            foreach ($collection->nonCore() as $instance) {

                $manifest[] = $instance->getPackageName();

                $entry = [
                    'namespace'   => $instance->getNamespace(),
                    'type'        => $instance->getType(),
                    'name'        => $instance->getPackageName(),
                    'title'       => $instance->getTitle(),
                    'homepage'    => array_get($instance->getComposerJson(), 'homepage'),
                    'description' => array_get($instance->getComposerJson(), 'description'),
                    'requires'    => array_get($instance->getComposerJson(), 'require', []),
                    'suggests'    => array_get($instance->getComposerJson(), 'suggest', []),
                    'versions'    => array_filter(
                        array_get($instance->getComposerJson(), 'versions', []),
                        function ($version) {
                            return !Str::contains($version, ['stable', 'RC', 'beta', 'alpha', 'dev']);
                        }
                    ),
                    'licenses'    => (array)array_get($instance->getComposerJson(), 'license', []),
                    'authors'     => array_get($instance->getComposerJson(), 'authors', []),
                    'support'     => array_get($instance->getComposerJson(), 'support', []),
                ];

                /* @var AddonInterface|EloquentModel $addon */
                if (!$addon = $addons->findByName($instance->getPackageName())) {

                    $this->info('Adding: ' . $instance->getPackageName());

                    file_put_contents($log, 'Adding: ' . $entry['name']);

                    $entry['assets'] = $this->assets(
                        ['name' => $instance->getPackageName()]
                    );

                    $entry['readme']      = $this->readme(
                        ['name' => $instance->getPackageName(), 'id' => $instance->getNamespace()]
                    );

                    $entry['marketplace'] = $this->marketplace(
                        ['name' => $instance->getPackageName()]
                    );

                    $addons->create($entry);

                    continue;
                }

                if ($entry['versions'] !== $addon->getVersions() || $this->option('force')) {

                    $this->info('Syncing: ' . $addon['name']);

                    file_put_contents($log, 'Syncing: ' . $addon['name']);

                    $entry['assets'] = $this->assets(
                        ['name' => $instance->getPackageName()]
                    );

                    $entry['readme'] = $this->readme(
                        ['name' => $instance->getPackageName(), 'id' => $instance->getNamespace()]
                    );

                    $entry['marketplace'] = $this->marketplace(
                        ['name' => $instance->getPackageName()]
                    );

                    $addon->fill($entry);

                    $addons->save($addon);

                    continue;
                }

                $this->info('Unchanged: ' . $addon['name']);

                file_put_contents($log, 'Unchanged: ' . $addon['name']);
            }
        }

        foreach ($addons->except($manifest) as $addon) {

            $this->info('Removing: ' . $addon->getName());

            file_put_contents($log, 'Removing: ' . $addon->getName());

            $addons->delete($addon);
        }

        $addons->flushCache();

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
                'https://assets.pyrocms.com/marketplace/'
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
                'https://assets.pyrocms.com/marketplace/'
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
                'https://assets.pyrocms.com/marketplace/'
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
