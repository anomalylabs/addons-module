<?php namespace Anomaly\AddonsModule\Console;

use Anomaly\AddonsModule\Addon\Contract\AddonRepositoryInterface;
use Anomaly\AddonsModule\Composer\ComposerProcess;
use Anomaly\AddonsModule\Console\Command\FinishUpdate;
use Anomaly\AddonsModule\Console\Command\RunProcess;
use Anomaly\Streams\Platform\Application\Application;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Log\Writer;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class Update
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Update extends Command
{

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'addon:update';

    /**
     * Handle the command.
     */
    public function handle(
        AddonRepositoryInterface $addons,
        Application $application,
        Filesystem $files,
        Writer $log
    ) {
        if (!$addon = $addons->findByName($this->argument('addon'))) {
            throw new \Exception("Addon [{$this->argument('addon')}] not found.");
        }

        if (!$addon->instance()) {

            $this->info("[{$addon->getName()}] is already updated.");

            return;
        }

        $process = ComposerProcess::make(
            'update',
            join(
                ' ',
                [
                    $addon->getName(),
                    '--verbose',
                ]
            )
        );

        dispatch_now(new RunProcess($this, $process));
        dispatch_now(new FinishUpdate($this, $addon));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['addon', InputArgument::REQUIRED, 'The addon in which to Update.'],
        ];
    }


    /**
     * Clean up after composer.
     *
     * @param Filesystem $files
     * @param Application $application
     * @param Writer $log
     */
    protected function cleanup(Filesystem $files, Application $application, Writer $log)
    {
        $log->info($files->get($application->getAssetsPath('composer.log')));
        $files->delete($application->getAssetsPath('composer.log'));
    }

}
