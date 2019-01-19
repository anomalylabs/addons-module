<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Addon\Contract\AddonInterface;
use Anomaly\AddonsModule\Addon\Contract\AddonRepositoryInterface;
use Anomaly\AddonsModule\Composer\ComposerAuthorizer;
use Anomaly\AddonsModule\Composer\ComposerFile;
use Anomaly\AddonsModule\Composer\ComposerProcess;
use Anomaly\Streams\Platform\Addon\AddonManager;
use Anomaly\Streams\Platform\Addon\Command\GetAddon;
use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Log\Writer;

/**
 * Class ComposerController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ComposerController extends AdminController
{

    /**
     * Clean up after composer.
     *
     * @param Filesystem $files
     * @param Application $application
     * @param Writer $log
     */
    public function cleanup(Filesystem $files, Application $application, Writer $log)
    {
        $log->info($files->get($application->getAssetsPath('addons/composer.lock')));
        $files->delete($application->getAssetsPath('addons/composer.lock'));
    }

    /**
     * Download an addon.
     *
     * @param AddonRepositoryInterface $addons
     * @param ComposerAuthorizer $authorizer
     * @param Application $application
     * @param AddonManager $manager
     * @param Filesystem $files
     * @param Writer $log
     * @param                          $addon
     * @throws \Exception
     */
    public function download(
        AddonRepositoryInterface $addons,
        ComposerAuthorizer $authorizer,
        Application $application,
        AddonManager $manager,
        Filesystem $files,
        Writer $log,
        $addon
    ) {

        $this->setTimeout();

        /* @var AddonInterface $addon */
        $addon = $addons->findByNamespace($addon);

        if (!$authorizer->authorize(__FUNCTION__, $addon->getType())) {
            throw new \Exception('[' . __FUNCTION__ . '] command is not permitted.');
        }

        $lock = $application->getAssetsPath('addons/composer.lock');

        $files->put($lock, '');

        $process = ComposerProcess::make('require', $addon['name']);

        $process->run(
            function ($type, $buffer) use ($log, $lock, $files) {

                if (empty($buffer = trim($buffer))) {
                    return;
                }

                $files->append($lock, $buffer . "\n");
                $log->info("{$type}: {$buffer}");
            }
        );

        $manager->register(true);

        if (!$addon->instance()) {

            ComposerFile::remove($addon->getName());

            $files->append($lock, "[{$addon->getName()}] could not be found. Download failed.");

            $this->cleanup($files, $application, $log);

            return;
        }

        $files->append($lock, "[{$addon->getName()}] has been downloaded.\n");

        $this->cleanup($files, $application, $log);
    }

    /**
     * Update an addon.
     *
     * @param AddonRepositoryInterface $addons
     * @param ComposerAuthorizer $authorizer
     * @param Application $application
     * @param Filesystem $files
     * @param Writer $log
     * @param                          $addon
     * @throws \Exception
     */
    public function update(
        AddonRepositoryInterface $addons,
        ComposerAuthorizer $authorizer,
        Application $application,
        Filesystem $files,
        Writer $log,
        $addon
    ) {
        $this->setTimeout();

        /* @var AddonInterface $addon */
        $addon = $addons->findByNamespace($addon);

        if (!$authorizer->authorize(__FUNCTION__, $addon->getType())) {
            throw new \Exception('[' . __FUNCTION__ . '] command is not permitted.');
        }

        $lock = $application->getAssetsPath('addons/composer.lock');

        $files->put($lock, '');

        $process = ComposerProcess::make('update', $addon->getName());

        $process->run(
            function ($type, $buffer) use ($log, $files, $lock) {

                if (empty($buffer = trim($buffer))) {
                    return;
                }

                $files->append($lock, $buffer . "\n");
                $log->info("{$type}: {$buffer}");
            }
        );

        $files->append($lock, "[{$addon->getName()}] has been updated.\n");

        $this->cleanup($files, $application, $log);
    }

    /**
     * Remove an addon.
     *
     * @TODO     Check for requirements elsewhere
     *       before doing this.. composer doesn't
     *       remove it so we have to delete. But
     *       first make sure it's safe! Edge case.
     *
     * @param AddonRepositoryInterface $addons
     * @param ComposerAuthorizer $authorizer
     * @param Application $application
     * @param AddonManager $manager
     * @param Filesystem $files
     * @param Writer $log
     * @param                          $addon
     * @throws \Exception
     */
    public function remove(
        AddonRepositoryInterface $addons,
        ComposerAuthorizer $authorizer,
        Application $application,
        AddonManager $manager,
        Filesystem $files,
        Writer $log,
        $addon
    ) {
        $this->setTimeout();

        /* @var AddonInterface $addon */
        $addon = $addons->findByNamespace($addon);

        if (!$authorizer->authorize(__FUNCTION__, $addon->getType())) {
            throw new \Exception('[' . __FUNCTION__ . '] command is not permitted.');
        }

        $lock = $application->getAssetsPath('addons/composer.lock');

        $files->put($lock, '');

        $process = ComposerProcess::make('remove', $addon->getName());

        $process->run(
            function ($type, $buffer) use ($log, $files, $lock) {

                if (empty($buffer = trim($buffer))) {
                    return;
                }

                $files->append($lock, $buffer . "\n");
                $log->info("{$type}: {$buffer}");
            }
        );

        $manager->register(true);

        if ($addon->instance()) {

            $files->append($lock, "[{$addon->getName()}] could not be removed. Removal failed.");

            $this->cleanup($files, $application, $log);

            return;
        }

        $files->append($lock, "[{$addon->getName()}] has been removed.\n");

        $this->cleanup($files, $application, $log);
    }

    /**
     * Set the max execution time - composer takes a while.
     *
     * @param null $seconds
     */
    protected function setTimeout($seconds = null)
    {
        $seconds = $seconds ?: 60 * 5;

        set_time_limit($seconds);
        ini_set('max_input_time', $seconds);
        ini_set('max_execution_time', $seconds);
    }

}
