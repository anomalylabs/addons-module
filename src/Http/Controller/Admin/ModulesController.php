<?php namespace Anomaly\Streams\Addon\Module\Addons\Http\Controller\Admin;

use Anomaly\Streams\Addon\Module\Addons\Ui\Table\ModuleTable;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class ModulesController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Module\Addons\Http\Controllers\Admin
 */
class ModulesController extends AdminController
{

    /**
     * Return an index of existing modules.
     *
     * @param ModuleTable $ui
     * @return mixed|null
     */
    public function index(ModuleTable $ui)
    {
        return $ui->render();
    }
}
 