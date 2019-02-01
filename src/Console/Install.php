<?php namespace Anomaly\AddonsModule\Console;

use Anomaly\AddonsModule\Addon\Contract\AddonRepositoryInterface;
use Anomaly\AddonsModule\Console\Command\FinishInstall;
use Anomaly\AddonsModule\Console\Command\RunProcess;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Process\Process;

/**
 * Class Install
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Install extends Command
{

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'addons:install';

    /**
     * Handle the command.
     *
     * @param AddonRepositoryInterface $addons
     * @throws \Exception
     */
    public function handle(AddonRepositoryInterface $addons)
    {
        if (!$addon = $addons->findByNamespace($this->argument('addon'))) {
            throw new \Exception("Addon [{$this->argument('addon')}] not found.");
        }

        /* @var Module|Extension $instance */
        if (!$instance = $addon->instance()) {
            throw new \Exception("Addon [{$addon->getName()}] is not installed.");
        }

        if (!in_array($type = $instance->getType(), ['module', 'extension'])) {
            throw new \Exception("Addon [{$addon->getName()}] is a [{$type}] type which is not installable.");
        }

        if ($instance->isInstalled()) {
            throw new \Exception("Addon [{$addon->getName()}] is already installed.");
        }

        $parameters = [
            $addon->getNamespace(),
            '--seed',
        ];

        $process = new Process(PHP_BINARY . ' artisan addon:install', join(' ', $parameters));

        dispatch_now(new RunProcess($this, $process));
        dispatch_now(new FinishInstall($this, $addon));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['addon', InputArgument::REQUIRED, 'The addon in which to install.'],
        ];
    }

}
