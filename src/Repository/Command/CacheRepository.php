<?php namespace Anomaly\AddonsModule\Repository\Command;

use Anomaly\AddonsModule\Repository\Contract\RepositoryInterface;
use Anomaly\AddonsModule\Repository\RepositoryInput;
use Anomaly\Streams\Platform\Application\Application;

/**
 * Class CacheRepository
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CacheRepository
{

    /**
     * The repository instance.
     *
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * Create a new CacheRepository instance.
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
     * @param RepositoryInput $input
     */
    public function handle(Application $application, RepositoryInput $input)
    {
        $filename = $application->getStoragePath('addons/' . md5($this->repository->getUrl()) . '.json');

        /**
         * Download and compile the include files
         * and prepare an array of addon information.
         */
        $includes = array_keys(
            json_decode(
                file_get_contents(
                    $this->repository->getUrl() . '/packages.json'
                ),
                true
            )['includes']
        );

        $packages = [];

        array_walk(
            $includes,
            function (&$include) use (&$packages) {

                $include = json_decode(
                    file_get_contents(
                        $this->repository->getUrl() . '/' . $include
                    ),
                    true
                )['packages'];

                $packages = array_merge($packages, $include);
            }
        );

        array_walk(
            $packages,
            function (&$availability) {

                $versions = $availability;

                $latest = array_pop($availability);

                $availability = $latest;

                unset($availability['version']);

                $availability['versions'] = array_keys($versions);
            }
        );

        $addons = $input->read(
            array_filter(
                $packages,
                function ($package) {

                    if (array_get($package, 'type') != 'streams-addon') {
                        return false;
                    }

                    return str_is(
                        [
                            '*/*-theme',
                            '*/*-plugin',
                            '*/*-module',
                            '*/*-extension',
                            '*/*-field_type',
                        ],
                        $package['name']
                    );
                }
            )
        );

        $directory = $application->getStoragePath('addons');

        if (!is_dir($directory)) {
            mkdir($directory);
        }

        file_put_contents($filename, json_encode($addons));
    }

}
