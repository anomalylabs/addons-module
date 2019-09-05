<?php namespace Anomaly\AddonsModule\Console;

use Anomaly\AddonsModule\Addon\Contract\AddonRepositoryInterface;
use Anomaly\AddonsModule\Composer\ComposerProcess;
use Anomaly\AddonsModule\Console\Command\FinishDownload;
use Anomaly\AddonsModule\Console\Command\RunProcess;
use Illuminate\Console\Command;
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
    protected $name = 'addons:download';

    /**
     * Handle the command.
     *
     * @param AddonRepositoryInterface $addons
     * @throws \Exception
     */
    public function handle(AddonRepositoryInterface $addons)
    {
        if (!$addon = $addons->findByNameOrNamespace($this->argument('addon'))) {
            throw new \Exception("Addon [{$this->argument('addon')}] not found.");
        }

        if ($addon->instance()) {
            throw new \Exception("Addon [{$addon->getName()}] is already downloaded.");
        }

        $parameters = [
            $addon->getName(),
            '--optimize-autoloader',
        ];

        if (env('APP_ENV') == 'production') {
            $parameters[] = '--no-dev';
        }

        $process = ComposerProcess::make('require', join(' ', $parameters));

        dispatch_now(new RunProcess($this, $process));
        dispatch_now(new FinishDownload($this, $addon));
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

}
