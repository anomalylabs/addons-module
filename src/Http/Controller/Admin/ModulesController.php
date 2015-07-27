<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Module\Table\ModuleTableBuilder;
use Illuminate\Routing\Redirector;

/**
 * Class ModulesController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Http\Controller\Admin
 */
class ModulesController extends AddonsController
{

    /**
     * Go to modules.
     *
     * @param Redirector $redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect(Redirector $redirect)
    {
        return $redirect->to('admin/addons/modules');
    }

    /**
     * Return an index of existing modules.
     *
     * @param ModuleTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ModuleTableBuilder $table)
    {
        return $table->render();
    }
}
