<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Addon\Contract\AddonRepositoryInterface;
use Anomaly\AddonsModule\Addon\Table\AddonTableBuilder;
use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionManager;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Addon\Module\ModuleManager;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Illuminate\Http\Request;

/**
 * Class AddonsController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param AddonTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AddonTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * View an addon.
     *
     * @param AddonRepositoryInterface $addons
     * @param                          $addon
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function view(AddonRepositoryInterface $addons, $addon)
    {
        $addon = $addons->findByNamespace($addon);

        $composer = app('composer.json');

        $constraint = array_get($composer['require'], $addon->getName());

        $this->breadcrumbs->add($addon->displayName());

        return $this->view->make(
            'anomaly.module.addons::admin/addon/view',
            compact('addon', 'constraint')
        );
    }

    /**
     * Return the modal form for the seed
     * option when installing modules.
     *
     * @param AddonCollection $addons
     * @param                 $namespace
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function options(AddonCollection $addons, $namespace)
    {
        /* @var Addon $addon */
        $addon = $addons->get($namespace);

        return $this->view->make(
            'anomaly.module.addons::ajax/install',
            compact('addon', 'type', 'namespace')
        );
    }

    /**
     * Install an addon.
     *
     * @param Request $request
     * @param ModuleManager $modules
     * @param AddonCollection $addons
     * @param ExtensionManager $extensions
     * @param                  $type
     * @param                  $addon
     * @return \Illuminate\Http\RedirectResponse
     */
    public function install(
        Request $request,
        ModuleManager $modules,
        AddonCollection $addons,
        ExtensionManager $extensions,
        $addon
    ) {
        $this->setTimeout();

        /* @var Addon|Module|Extension $addon */
        $addon = $addons->get($addon);

        if ($addon instanceof Module) {
            $modules->install($addon, filter_var($request->input('seed'), FILTER_VALIDATE_BOOLEAN));
        } elseif ($addon instanceof Extension) {
            $extensions->install($addon, filter_var($request->input('seed'), FILTER_VALIDATE_BOOLEAN));
        }

        $this->messages->success('module::message.install_addon_success');

        return $this->redirect->back();
    }

    /**
     * Uninstall an addon.
     *
     * @param AddonCollection $addons
     * @param ModuleManager $modules
     * @param ExtensionManager $extensions
     * @param                  $addon
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uninstall(
        AddonCollection $addons,
        ModuleManager $modules,
        ExtensionManager $extensions,
        $addon
    ) {
        $this->setTimeout();

        /* @var Addon|Module|Extension $addon */
        $addon = $addons->get($addon);

        if ($addon instanceof Module) {
            $modules->uninstall($addon);
        } elseif ($addon instanceof Extension) {
            $extensions->uninstall($addon);
        }

        $this->messages->success('module::message.uninstall_addon_success');

        return $this->redirect->back();
    }

    /**
     * Enable an addon.
     *
     * @param ModuleManager $modules
     * @param AddonCollection $addons
     * @param ExtensionManager $extensions
     * @param                  $addon
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enable(
        ModuleManager $modules,
        AddonCollection $addons,
        ExtensionManager $extensions,
        $addon
    ) {

        /* @var Addon|Module|Extension $addon */
        $addon = $addons->get($addon);

        if ($addon instanceof Module) {
            $modules->enable($addon);
        } elseif ($addon instanceof Extension) {
            $extensions->enable($addon);
        }

        return $this->redirect->back();
    }

    /**
     * Disable an addon.
     *
     * @param AddonCollection $addons
     * @param ModuleManager $modules
     * @param ExtensionManager $extensions
     * @param $addon
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disable(
        AddonCollection $addons,
        ModuleManager $modules,
        ExtensionManager $extensions,
        $addon
    ) {

        /* @var Addon|Module|Extension $addon */
        $addon = $addons->get($addon);

        if ($addon instanceof Module) {
            $modules->disable($addon);
        } elseif ($addon instanceof Extension) {
            $extensions->disable($addon);
        }

        return $this->redirect->back();
    }

    /**
     * Migrate an addon.
     *
     * @param ModuleManager $modules
     * @param AddonCollection $addons
     * @param ExtensionManager $extensions
     * @param                  $addon
     * @return \Illuminate\Http\RedirectResponse
     */
    public function migrate(
        ModuleManager $modules,
        AddonCollection $addons,
        ExtensionManager $extensions,
        $addon
    ) {
        $this->setTimeout();

        /* @var Addon|Module|Extension $addon */
        $addon = $addons->get($addon);

        if ($addon instanceof Module) {
            $modules->migrate($addon, false);
        } elseif ($addon instanceof Extension) {
            $extensions->migrate($addon, false);
        }

        $this->messages->success('module::message.migrate_addon_success');

        return $this->redirect->back();
    }

    /**
     * Set the max execution time - composer takes a while.
     *
     * @param null $seconds
     */
    protected function setTimeout($seconds = null)
    {
        $seconds = $seconds ?: 60 * 5;

        set_time_limit($seconds);
        ini_set('max_input_time', $seconds);
        ini_set('max_execution_time', $seconds);
    }

}
