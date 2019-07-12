<?php namespace Anomaly\AddonsModule\Console\Command;

use Anomaly\AddonsModule\Addon\Contract\AddonInterface;
use Anomaly\Streams\Platform\Addon\AddonManager;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Application\Application;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

/**
 * Class FinishInstall
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FinishInstall
{

    /**
     * The addon record.
     *
     * @var AddonInterface
     */
    protected $addon;

    /**
     * The command instance.
     *
     * @var Command
     */
    protected $command;

    /**
     * Create a new FinishInstall instance.
     *
     * @param Command $command
     * @param AddonInterface $addon
     */
    public function __construct(Command $command, AddonInterface $addon)
    {
        $this->addon   = $addon;
        $this->command = $command;
    }

    /**
     * Handle the command.
     *
     * @param Application $application
     * @param AddonManager $manager
     * @param Filesystem $files
     */
    public function handle(Application $application, AddonManager $manager, Filesystem $files)
    {
        sleep(2);

        /* @var Module|Extension $addon */
        $addon = $this->addon->instance();

        $log = $application->getAssetsPath('process.log');

        $manager->register(true);

        if (!$addon->isInstalled()) {

            $files->append($log, "[{$this->addon->getName()}] install failed.");

            $this->command->error("[{$this->addon->getName()}] install failed.");

            $files->delete($log);

            return;
        }

        $files->append($log, "[{$this->addon->getName()}] installed successfully.");

        $this->command->info("[{$this->addon->getName()}] installed successfully.");

        $files->delete($log);
    }

}
