<?php namespace Anomaly\AddonsModule\Console;

use Anomaly\AddonsModule\Addon\Contract\AddonRepositoryInterface;
use Anomaly\AddonsModule\Composer\ComposerFile;
use Anomaly\AddonsModule\Composer\ComposerProcess;
use Anomaly\Streams\Platform\Addon\AddonManager;
use Anomaly\Streams\Platform\Application\Application;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Log\Writer;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class Download
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Download extends Command
{

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'addon:download';

    /**
     * Handle the command.
     */
    public function handle(
        AddonRepositoryInterface $addons,
        Application $application,
        AddonManager $manager,
        Filesystem $files,
        Writer $log
    ) {
        if (!$addon = $addons->findByName($this->argument('addon'))) {
            throw new \Exception("Addon [{$this->argument('addon')}] not found.");
        }

        if ($addon->instance()) {

            $this->info("[{$addon->getName()}] is already downloaded.");

            return;
        }

        $lock = $application->getAssetsPath('composer.log');

        $files->put($lock, '');

        $process = ComposerProcess::make(
            'require',
            join(
                ' ',
                [
                    $addon->getName(),
                    '--update-with-dependencies',
                    '--optimize-autoloader',
                    //'--update-no-dev',
                    //'--no-update',
                ]
            )
        );

        $process->run(
            function ($type, $buffer) use ($log, $lock, $files) {

                if (empty($buffer = trim($buffer))) {
                    return;
                }

                $files->put($lock, $buffer);

                $this->info("{$buffer}");
            }
        );

        $manager->register(true);

        if (!$addon->instance()) {

            ComposerFile::remove($addon->getName());

            $files->append($lock, "[{$addon->getName()}] could not be found. Download failed.");

            $this->error("[{$addon->getName()}] could not be found. Download failed.");

            $this->cleanup($files, $application, $log);

            return;
        }

        $files->append($lock, "[{$addon->getName()}] has been downloaded.");

        $this->info("[{$addon->getName()}] has been downloaded.");

        $this->cleanup($files, $application, $log);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['addon', InputArgument::REQUIRED, 'The addon in which to download.'],
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
