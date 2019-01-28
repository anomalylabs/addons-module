<?php namespace Anomaly\AddonsModule\Console\Command;

use Anomaly\AddonsModule\Addon\Contract\AddonInterface;
use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\AddonManager;
use Anomaly\Streams\Platform\Application\Application;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

/**
 * Class FinishRemove
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FinishRemove
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
     * Create a new FinishRemove instance.
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
        $log = $application->getAssetsPath('process.log');

        $manager->register(true);

        /* @var Addon $instance */
        if (($instance = $this->addon->instance()) && is_dir($instance->getPath())) {

            $files->append($log, "[{$this->addon->getName()}] could not be removed. Removal failed.");

            $this->command->error("[{$this->addon->getName()}] could not be removed. Removal failed.");

            $files->delete($log);

            return;
        }

        $files->append($log, "[{$this->addon->getName()}] has been removed.");

        $this->command->info("[{$this->addon->getName()}] has been removed.");

        $files->delete($log);
    }

}
