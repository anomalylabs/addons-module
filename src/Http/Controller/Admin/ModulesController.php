<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Module\Table\ModuleTableBuilder;
use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Addon\Module\ModuleManager;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Illuminate\Routing\Redirector;

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
     * The module collection.
     *
     * @var ModuleCollection
     */
    protected $modules;

    /**
     * Create a new ModulesController instance.
     *
     * @param ModuleCollection $modules
     */
    public function __construct(ModuleCollection $modules)
    {
        parent::__construct();

        $this->modules = $modules;
    }

    /**
     * Redirect to modules.
     *
     * @param Redirector $redirector
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect(Redirector $redirector)
    {
        return $redirector->to('admin/addons/modules');
    }

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
     * @param               $module
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function install(ModuleManager $modules, $module)
    {
        $modules->install($this->modules->get($module));

        return redirect()->back();
    }

    /**
     * Uninstall a module.
     *
     * @param ModuleManager $modules
     * @param               $module
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function uninstall(ModuleManager $modules, $module)
    {
        $modules->uninstall($this->modules->get($module));

        return redirect()->back();
    }

    /**
     * Output the readme for a module.
     *
     * @param $module
     * @return \Illuminate\View\View
     */
    public function readme($module)
    {
        $addon = $this->modules->get($module);

        $readme = $addon->getPath('README.md');

        if (file_exists($readme)) {
            $readme = file_get_contents($readme);
        }

        return view('module::admin/modals/readme', compact('addon', 'readme'));
    }
}
