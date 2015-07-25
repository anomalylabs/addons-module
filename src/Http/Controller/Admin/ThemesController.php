<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Theme\Table\ThemeTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class ThemesController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Http\Controller\Admin
 */
class ThemesController extends AdminController
{

    /**
     * Return an index of existing themes.
     *
     * @param ThemeTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ThemeTableBuilder $table)
    {
        return $table->render();
    }
}
