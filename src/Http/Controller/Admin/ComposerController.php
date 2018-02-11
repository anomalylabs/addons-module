<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Addon\Command\DeleteAddon;
use Anomaly\AddonsModule\Addon\Command\GetAddonDetails;
use Anomaly\AddonsModule\Composer\ComposerAuthorizer;
use Anomaly\AddonsModule\Composer\ComposerFile;
use Anomaly\AddonsModule\Composer\ComposerProcess;
use Anomaly\Streams\Platform\Addon\AddonManager;
use Anomaly\Streams\Platform\Addon\Command\GetAddon;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
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
     * Download an addon.
     *
     * @param ComposerAuthorizer $authorizer
     * @param AddonManager       $manager
     * @param Writer             $log
     * @throws \Exception
     */
    public function download(ComposerAuthorizer $authorizer, AddonManager $manager, Writer $log)
    {
        if (!$authorizer->authorize(__FUNCTION__, $this->route->parameter('type'))) {
            throw new \Exception('[' . __FUNCTION__ . '] command is not permitted.');
        }

        $addon = $this->dispatch(
            new GetAddonDetails(
                $this->route->parameter('addon')
            )
        );

        $process = ComposerProcess::make('require', $addon['name']);

        $process->run(
            function ($type, $buffer) use ($log) {

                if (empty($buffer = trim($buffer))) {
                    return;
                }

                $log->info("{$type}: {$buffer}");
            }
        );

        $manager->register(true);

        if (!$this->dispatch(new GetAddon($addon['id']))) {

            ComposerFile::remove($addon['name']);

            throw new \Exception("[{$addon['id']}] could not be found. Download failed.");
        }
    }

    /**
     * Update an addon.
     *
     * @param ComposerAuthorizer $authorizer
     * @param Writer             $log
     * @throws \Exception
     */
    public function update(ComposerAuthorizer $authorizer, Writer $log)
    {
        if (!$authorizer->authorize(__FUNCTION__, $this->route->parameter('type'))) {
            throw new \Exception('[' . __FUNCTION__ . '] command is not permitted.');
        }

        $addon = $this->dispatch(
            new GetAddonDetails(
                $this->route->parameter('addon')
            )
        );

        $process = ComposerProcess::make('update', $addon['name']);

        $process->run(
            function ($type, $buffer) use ($log) {

                if (empty($buffer = trim($buffer))) {
                    return;
                }

                $log->info("{$type}: {$buffer}");
            }
        );
    }

    /**
     * Remove an addon.
     *
     * @TODO     Check for requirements elsewhere
     *       before doing this.. composer doesn't
     *       remove it so we have to delete. But
     *       first make sure it's safe! Edge case.
     *
     * @param ComposerAuthorizer $authorizer
     * @param AddonManager       $manager
     * @param Writer             $log
     * @throws \Exception
     * @internal param $addon
     */
    public function remove(ComposerAuthorizer $authorizer, AddonManager $manager, Writer $log)
    {
        if (!$authorizer->authorize(__FUNCTION__, $this->route->parameter('type'))) {
            throw new \Exception('[' . __FUNCTION__ . '] command is not permitted.');
        }

        $addon = $this->dispatch(
            new GetAddonDetails(
                $this->route->parameter('addon')
            )
        );

        ComposerFile::remove($addon['name']);

        $this->dispatch(new DeleteAddon($addon['id']));

        $process = ComposerProcess::make('remove', $addon['name']);

        $process->run(
            function ($type, $buffer) use ($log) {

                if (empty($buffer = trim($buffer))) {
                    return;
                }

                $log->info("{$type}: {$buffer}");
            }
        );

        $manager->register(true);

        if ($this->dispatch(new GetAddon($addon['id']))) {
            throw new \Exception("[{$addon['id']}] could not be removed. Removal failed.");
        }
    }

}
