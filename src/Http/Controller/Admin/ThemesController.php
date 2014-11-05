<?php namespace Anomaly\Streams\Addon\Module\Addons\Http\Controller\Admin;

use Anomaly\Streams\Addon\Module\Addons\Ui\Table\ThemeTable;
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
     * Return an index of existing modules.
     *
     * @param ThemeTable $ui
     * @return mixed|null
     */
    public function index(ThemeTable $ui)
    {
        return $ui->render();
    }
}
 