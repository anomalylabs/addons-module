<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Ui\Table\ThemeTableBuilder;
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
     * @return mixed|null
     */
    public function index(ThemeTableBuilder $table)
    {
        return $table->render();
    }
}
 