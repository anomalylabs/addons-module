<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Ui\Table\Module\ModuleTableBuilder;
use Anomaly\Streams\Platform\Addon\Module\ModuleManager;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class ModulesController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Http\Controllers\Admin
 */
class ModulesController extends AdminController
{

    /**
     * Return an index of existing modules.
     *
     * @param \Anomaly\AddonsModule\Ui\Table\Module\ModuleTableBuilder $table
     * @return mixed|null
     */
    public function index(ModuleTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Install a module.
     *
     * @param ModuleManager $modules
     * @param               $slug
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function install(ModuleManager $modules, $slug)
    {
        $modules->install($slug);

        return redirect()->back();
    }

    /**
     * Uninstall a module.
     *
     * @param ModuleManager $modules
     * @param               $slug
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function uninstall(ModuleManager $modules, $slug)
    {
        $modules->uninstall($slug);

        return redirect()->back();
    }
}
