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
     * @param ModuleTableBuilder $ui
     * @return mixed|null
     */
    public function index(ModuleTableBuilder $ui)
    {
        return $ui->render();
    }

    /**
     * Install a module.
     *
     * @param ModuleService $modules
     * @param               $slug
     */
    public function install(ModuleService $modules, $slug)
    {
        $module = app('streams.modules')->findBySlug($slug);

        if ($modules->install($module)) {

            app('streams.messages')->add('success', trans('module.addons::admin.success.install_module'))->flash();
        } else {

            app('streams.messages')->add('error', trans('module.addons::admin.error.install_module'))->flash();
        }

        return redirect(referer('admin/addons/modules'));
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

        if ($modules->uninstall($module)) {
            app('streams.messages')->add('success', trans('module.addons::admin.success.uninstall_module'))->flash();
        } else {

            app('streams.messages')->add('error', trans('module.addons::admin.error.uninstall_module'))->flash();
        }

        return redirect(referer('admin/addons/modules'));
    }
}
 