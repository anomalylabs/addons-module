<?php namespace Anomaly\AddonsModule\Console\Command;

use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Application\Command\ReadEnvironmentFile;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

/**
 * Class RunProcess
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RunProcess
{

    /**
     * The command instance.
     *
     * @var Command
     */
    protected $command;

    /**
     * The process instance.
     *
     * @var Process
     */
    protected $process;

    /**
     * Create a new RunProcess instance.
     *
     * @param Command $command
     * @param Process $process
     */
    public function __construct(Command $command, Process $process)
    {
        $this->command = $command;
        $this->process = $process;
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

        $files->put($log, '');

        $this->process->run(
            function ($type, $buffer) use ($log, $files) {

                if (empty($buffer = trim($buffer))) {
                    return;
                }

                $files->put($log, $buffer);

                $this->command->info("{$buffer}");
            }
        );

        if (!$this->process->isSuccessful()) {
            $files->put($log, $this->process->getErrorOutput());
        }
    }
}
