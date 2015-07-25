<?php namespace Anomaly\AddonsModule\Theme\Table\Action;

use Anomaly\Streams\Platform\Addon\Theme\Theme;
use Anomaly\Streams\Platform\Addon\Theme\ThemeCollection;
use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Filesystem\Filesystem;

/**
 * Class DeleteTheme
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Theme\Table\Action
 */
class DeleteTheme extends ActionHandler implements SelfHandling
{

    /**
     * Handle the action.
     *
     * @param $selected
     */
    public function handle(ThemeCollection $themes, Filesystem $files, $selected)
    {
        $count = 0;

        foreach ($selected as $theme) {

            /* @var Theme $theme */
            $theme = $themes->get($theme);

            if ($files->isWritable($theme->getPath()) && $files->deleteDirectory($theme->getPath())) {
                $count++;
            }
        }

        $this->messages->success(trans('theme::success.delete_themes', compact('count')));
    }
}
