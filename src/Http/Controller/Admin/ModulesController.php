<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Module\Table\ModuleTableBuilder;
use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
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
     * @param ModuleTableBuilder $table
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
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

    /**
     * Output the readme for a module.
     *
     * @param                  $module
     * @param ModuleCollection $modules
     * @return \Illuminate\View\View
     */
    public function readme($module, ModuleCollection $modules)
    {
        $addon = $modules->get($module);

        $readme = $addon->getPath('README.md');

        if (file_exists($readme)) {
            $readme = file_get_contents($readme);
        }

        return view('module::admin/modals/readme', compact('addon', 'readme'));
    }
}
