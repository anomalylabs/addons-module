<?php namespace Anomaly\AddonsModule\Console\Command;

use Anomaly\AddonsModule\Addon\Contract\AddonInterface;
use Anomaly\Streams\Platform\Application\Application;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

/**
 * Class FinishUpdate
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FinishUpdate
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
     * Create a new FinishUpdate instance.
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
     * @param Filesystem $files
     */
    public function handle(Application $application, Filesystem $files)
    {
        $log = $application->getAssetsPath('process.log');

        $files->append($log, "[{$this->addon->getName()}] has been updated.");

        $this->command->info("[{$this->addon->getName()}] has been updated.");

        $files->delete($log);
    }

}
