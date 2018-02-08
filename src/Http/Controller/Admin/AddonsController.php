<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Addon\Table\AddonTableBuilder;
use Anomaly\AddonsModule\Addon\Table\Command\GetAllAddons;
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
     * Return an index of existing entries.
     *
     * @param  AddonTableBuilder $builder
     * @param  string            $type
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AddonTableBuilder $builder, $type = 'modules')
    {
        $builder->setType($type);

        return $builder->render();
    }

    /**
     * View an addon.
     *
     * @param AddonCollection $downloaded
     * @param                 $repository
     * @param                 $addon
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function view(AddonCollection $downloaded, $repository, $addon)
    {
        $addons = $this->dispatch(new GetAllAddons($repository));

        $addon = array_first(
            $addons,
            function ($item) use ($addon) {
                return $item['id'] == $addon;
            }
        );

        /* @var Addon $instance */
        if ($instance = $downloaded->get($addon['id'])) {

            $addon['downloaded'] = true;
            $addon['readme']     = $instance->getReadme();
            $addon['path']       = $instance->getAppPath();

            if ($instance instanceof Module || $instance instanceof Extension) {

                $addon['enabled']   = $instance->isEnabled();
                $addon['installed'] = $instance->isInstalled();
            }

            if ($instance instanceof Extension) {

                $addon['provides'] = $instance->getProvides();
            }
        }

        return $this->view->make(
            'anomaly.module.addons::admin/addon/view',
            compact('addon')
        );
    }

    /**
     * Return the modal form for the seed
     * option when installing modules.
     *
     * @param AddonCollection $addons
     * @param                 $namespace
     * @return
     */
    public function options(AddonCollection $addons, $namespace)
    {
        /* @var Addon $addon */
        $addon = $addons->get($namespace);

        return $this->view->make(
            'anomaly.module.addons::ajax/install',
            compact('addon', 'namespace')
        );
    }

    /**
     * Install an addon.
     *
     * @param Request          $request
     * @param ModuleManager    $modules
     * @param AddonCollection  $addons
     * @param ExtensionManager $extensions
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
     * @param AddonCollection  $addons
     * @param ModuleManager    $modules
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
     * @param ModuleManager    $modules
     * @param AddonCollection  $addons
     * @param ExtensionManager $extensions
     * @param                  $addon
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Enable(
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
     * @param AddonCollection  $addons
     * @param ModuleManager    $modules
     * @param ExtensionManager $extensions
     * @param                  $addon
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
            $extensions->dispatch($addon);
        }

        return $this->redirect->back();
    }

//    public function download()
//    {
//        $process = new Process(
//            '/Applications/MAMP/bin/php/php7.0.20/bin/php ./bin/composer require ' . $this->request->get('package'),
//            base_path(),
//            $_ENV + ['COMPOSER_HOME' => base_path('bin')]
//        );
//
//        $process->start();
//
//        foreach ($process as $type => $data) {
//            if ($process::OUT === $type) {
//                echo $data . "<br>";
//            } else {
//                echo "[ERR] " . $data . "<br>";
//            }
//        }
//        die;
//    }
}
