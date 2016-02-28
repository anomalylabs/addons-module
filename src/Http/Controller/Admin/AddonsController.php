<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Addon\Table\AddonTableBuilder;
use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionManager;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Addon\Module\ModuleManager;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;

/**
 * Class AddonsController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\AddonsModule\Http\Controller\Admin
 */
class AddonsController extends AdminController
{

    /**
     * Return an index of existing entries.
     *
     * @param AddonTableBuilder $builder
     * @param string            $type
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AddonTableBuilder $builder, $type = 'modules')
    {
        $builder->setType($type);

        return $builder->render();
    }

    /**
     * Return the details for an addon.
     *
     * @param AddonCollection $addons
     * @param                 $addon
     * @return mixed|null|string
     */
    public function details(AddonCollection $addons, $addon)
    {
        /* @var Addon $addon */
        $addon = $addons->get($addon);

        $json = $addon->getComposerJson();

        return view('module::ajax/details', compact('json', 'addon'))->render();
    }

    /**
     * Ask the user for any options when installing the addon.
     *
     * @param AddonCollection $addons
     * @param                 $addon
     * @return mixed|null|string
     */
    public function installOptions(AddonCollection $addons, $namespace)
    {
        /* @var Addon $addon */
        $addon = $addons->get($namespace);

        $json = $addon->getComposerJson();

        return view('module::ajax/install', compact('json', 'addon', 'namespace'))->render();
    }

    /**
     * Install an addon.
     *
     * @param AddonCollection  $addons
     * @param ModuleManager    $modules
     * @param ExtensionManager $extensions
     * @param                  $addon
     * @return \Illuminate\Http\RedirectResponse
     */
    public function install(Request $request, AddonCollection $addons, ModuleManager $modules, ExtensionManager $extensions, $addon)
    {
        $seed = filter_var($request->input('seed'), FILTER_VALIDATE_BOOLEAN);

        /* @var Addon $addon */
        $addon = $addons->get($addon);

        if ($addon instanceof Module) {
            $modules->install($addon, $seed);
        } elseif ($addon instanceof Extension) {
            $extensions->install($addon);
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
    public function uninstall(AddonCollection $addons, ModuleManager $modules, ExtensionManager $extensions, $addon)
    {
        /* @var Addon $addon */
        $addon = $addons->get($addon);

        if ($addon instanceof Module) {
            $modules->uninstall($addon);
        } elseif ($addon instanceof Extension) {
            $extensions->uninstall($addon);
        }

        $this->messages->success('module::message.uninstall_addon_success');

        return $this->redirect->back();
    }
}
