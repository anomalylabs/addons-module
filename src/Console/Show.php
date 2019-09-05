<?php namespace Anomaly\AddonsModule\Console;

use Anomaly\AddonsModule\Addon\Contract\AddonRepositoryInterface;
use Anomaly\AddonsModule\Composer\ComposerProcess;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class Show
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Show extends Command
{

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'addons:show';

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

        if (!$instance = $addon->instance()) {
            throw new \Exception("Addon [{$this->argument('addon')}] is not downloaded.");
        }

        $parameters = [
            $addon->getName(),
        ];

        $process = ComposerProcess::make('show', join(' ', $parameters));

        if ($instance instanceof Module || $instance instanceof Extension) {
            $this->info('installed: ' . ($instance->isInstalled() ? 'true' : 'false'));
            $this->info('enabled  : ' . ($instance->isEnabled() ? 'true' : 'false'));
        }

        $process->run(
            function ($type, $buffer) {

                if (empty($buffer = trim($buffer))) {
                    return;
                }

                $this->info("{$buffer}");
            }
        );
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['addon', InputArgument::REQUIRED, 'The addon package/namespace in which to show details for.'],
        ];
    }

}
