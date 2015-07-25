<?php namespace Anomaly\AddonsModule\Plugin\Table\Action;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\Streams\Platform\Addon\Plugin\PluginCollection;
use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Filesystem\Filesystem;

/**
 * Class DeletePlugin
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Plugin\Table\Action
 */
class DeletePlugin extends ActionHandler implements SelfHandling
{

    /**
     * Handle the action.
     *
     * @param $selected
     */
    public function handle(PluginCollection $plugins, Filesystem $files, $selected)
    {
        $count = 0;

        foreach ($selected as $plugin) {

            /* @var Plugin $plugin */
            $plugin = $plugins->get($plugin);

            if ($files->isWritable($plugin->getPath()) && $files->deleteDirectory($plugin->getPath())) {
                $count++;
            }
        }

        $this->messages->success(trans('module::success.delete_plugins', compact('count')));
    }
}
