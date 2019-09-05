<?php namespace Anomaly\AddonsModule\Listener;

use Anomaly\Streams\Platform\Application\Event\SystemIsRefreshing;
use Anomaly\Streams\Platform\Console\Kernel;

/**
 * Class RefreshAddonsModule
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RefreshAddonsModule
{

    /**
     * Handle the command.
     *
     * @param SystemIsRefreshing $event
     */
    public function handle(SystemIsRefreshing $event)
    {
        $command = $event->getCommand();

        app(Kernel::class)->call('addons:sync');

        $command->info('Addon information updated.');
    }
}
