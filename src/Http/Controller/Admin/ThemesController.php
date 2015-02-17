<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Theme\Table\ThemeTableBuilder;
use Anomaly\Streams\Platform\Addon\Theme\ThemeCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class ThemesController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Theme\Addons\Http\Controllers\Admin
 */
class ThemesController extends AdminController
{

    /**
     * Return an index of existing themes.
     *
     * @param ThemeTableBuilder $table
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function index(ThemeTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Output the readme for a theme.
     *
     * @param                  $theme
     * @param ThemeCollection  $themes
     * @return \Illuminate\View\View
     */
    public function readme($theme, ThemeCollection $themes)
    {
        $addon = $themes->get($theme);

        $readme = $addon->getPath('README.md');

        if (file_exists($readme)) {
            $readme = file_get_contents($readme);
        }

        return view('module::admin/modals/readme', compact('addon', 'readme'));
    }
}
