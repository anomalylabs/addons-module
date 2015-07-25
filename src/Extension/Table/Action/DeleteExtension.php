<?php namespace Anomaly\AddonsModule\Extension\Table\Action;

use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Filesystem\Filesystem;

/**
 * Class DeleteExtension
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Extension\Table\Action
 */
class DeleteExtension extends ActionHandler implements SelfHandling
{

    /**
     * Handle the action.
     *
     * @param $selected
     */
    public function handle(ExtensionCollection $extensions, Filesystem $files, $selected)
    {
        $count = 0;

        foreach ($selected as $extension) {

            /* @var Extension $extension */
            $extension = $extensions->get($extension);

            if ($files->isWritable($extension->getPath()) && $files->deleteDirectory($extension->getPath())) {
                $count++;
            }
        }

        $this->messages->success(trans('module::success.delete_extensions', compact('count')));
    }
}
