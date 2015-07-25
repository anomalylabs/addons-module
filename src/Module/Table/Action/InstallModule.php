<?php namespace Anomaly\AddonsModule\Module\Table\Action;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Addon\Module\ModuleManager;
use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class InstallModule
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Module\Table\Action
 */
class InstallModule extends ActionHandler implements SelfHandling
{

    /**
     * Handle the action.
     *
     * @param $selected
     */
    public function handle(ModuleManager $manager, ModuleCollection $modules, $selected)
    {
        foreach ($selected as $module) {
            $manager->install($modules->get($module));
        }

        $this->messages->success(trans('module::success.install_modules_success', ['count' => count($selected)]));
    }
}
