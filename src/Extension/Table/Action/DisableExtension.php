<?php namespace Anomaly\AddonsModule\Extension\Table\Action;

use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionManager;
use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class DisableExtension
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Extension\Table\Action
 */
class DisableExtension extends ActionHandler implements SelfHandling
{

    /**
     * Handle the action.
     *
     * @param $selected
     */
    public function handle(ExtensionManager $manager, ExtensionCollection $extensions, $selected)
    {
        foreach ($selected as $extension) {
            $manager->disable($extensions->get($extension));
        }

        $this->messages->success(trans('module::success.disable_extensions', ['count' => count($selected)]));
    }
}
