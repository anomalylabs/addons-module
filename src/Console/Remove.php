<?php namespace Anomaly\AddonsModule\Console;

use Anomaly\AddonsModule\Addon\Contract\AddonRepositoryInterface;
use Anomaly\AddonsModule\Composer\ComposerProcess;
use Anomaly\AddonsModule\Console\Command\FinishRemove;
use Anomaly\AddonsModule\Console\Command\RunProcess;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class Remove
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Remove extends Command
{

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'addon:remove';

    /**
     * Handle the command.
     *
     * @param AddonRepositoryInterface $addons
     * @throws \Exception
     */
    public function handle(AddonRepositoryInterface $addons)
    {
        if (!$addon = $addons->findByName($this->argument('addon'))) {
            throw new \Exception("Addon [{$this->argument('addon')}] not found.");
        }

        if (!$addon->instance()) {

            $this->info("[{$addon->getName()}] is already removed.");

            return;
        }

        $process = ComposerProcess::make(
            'remove',
            join(
                ' ',
                [
                    $addon->getName(),
                    '--optimize-autoloader',
                    '--verbose',
                ]
            )
        );

        dispatch_now(new RunProcess($this, $process));
        dispatch_now(new FinishRemove($this, $addon));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['addon', InputArgument::REQUIRED, 'The addon in which to Remove.'],
        ];
    }

}
