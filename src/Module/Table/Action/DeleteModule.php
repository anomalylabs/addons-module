<?php namespace Anomaly\AddonsModule\Module\Table\Action;

use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Filesystem\Filesystem;

/**
 * Class DeleteModule
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Module\Table\Action
 */
class DeleteModule extends ActionHandler implements SelfHandling
{

    /**
     * Handle the action.
     *
     * @param $selected
     */
    public function handle(ModuleCollection $modules, Filesystem $files, $selected)
    {
        $count = 0;

        foreach ($selected as $module) {

            /* @var Module $module */
            $module = $modules->get($module);

            if ($files->isWritable($module->getPath()) && $files->deleteDirectory($module->getPath())) {
                $count++;
            }
        }

        $this->messages->success(trans('module::success.delete_modules_success', compact('count')));
    }
}
