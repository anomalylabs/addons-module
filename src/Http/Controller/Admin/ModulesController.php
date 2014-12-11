<?php namespace Anomaly\Streams\Addon\Module\Addons\Http\Controller\Admin;

use Anomaly\Streams\Addon\Module\Addons\Ui\Table\ModuleTableBuilder;
use Anomaly\Streams\Platform\Addon\Module\ModuleService;
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
     * @param ModuleTableBuilder $table
     * @return mixed|null
     */
    public function index(ModuleTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Install a module.
     *
     * @param ModuleService $modules
     * @param               $slug
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function install(ModuleService $modules, $slug)
    {
        $module = app('streams.modules')->findBySlug($slug);

        $modules->install($module);

        return redirect()->back();
    }

    /**
     * Uninstall a module.
     *
     * @param ModuleService $modules
     * @param               $slug
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function uninstall(ModuleService $modules, $slug)
    {
        $module = app('streams.modules')->findBySlug($slug);

        $modules->uninstall($module);

        return redirect()->back();
    }
}
 