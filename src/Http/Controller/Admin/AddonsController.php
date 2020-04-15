<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Addon\Contract\AddonInterface;
use Anomaly\AddonsModule\Addon\Contract\AddonRepositoryInterface;
use Anomaly\AddonsModule\Addon\Table\AddonTableBuilder;
use Anomaly\AddonsModule\Composer\ComposerAuthorizer;
use Anomaly\AddonsModule\Http\Middleware\CheckRepositoryAge;
use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionManager;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Addon\Module\ModuleManager;
use Anomaly\Streams\Platform\Asset\Asset;
use Anomaly\Streams\Platform\Console\Kernel;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

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
     * Create a new AddonsController instance.
     *
     * @param Asset $asset
     */
    public function __construct(Asset $asset)
    {
        parent::__construct();

        $this->middleware(CheckRepositoryAge::class);

        $asset->add('scripts.js', 'anomaly.module.addons::js/addons.js');
    }

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
     * Install an addon.
     *
     * @param ModuleManager $modules
     * @param AddonCollection $addons
     * @param ExtensionManager $extensions
     * @param $addon
     * @return \Illuminate\Http\RedirectResponse
     */
    public function install(
        ModuleManager $modules,
        AddonCollection $addons,
        ExtensionManager $extensions,
        $addon
    ) {
        $this->setTimeout();

        /* @var Addon|Module|Extension $addon */
        $addon = $addons->get($addon);

        if ($addon instanceof Module) {
            $modules->install($addon, true);
        } elseif ($addon instanceof Extension) {
            $extensions->install($addon, true);
        }

        $this->messages->success('anomaly.module.addons::message.install_addon_success');

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

        $this->messages->success('anomaly.module.addons::message.uninstall_addon_success');

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

        $this->messages->success('anomaly.module.addons::message.migrate_addon_success');

        return $this->redirect->back();
    }

    /**
     * Download an addon.
     *
     * @param AddonRepositoryInterface $addons
     * @param ComposerAuthorizer $authorizer
     * @param Kernel $console
     * @param $addon
     * @throws \Exception
     */
    public function download(
        AddonRepositoryInterface $addons,
        ComposerAuthorizer $authorizer,
        Kernel $console,
        $addon
    ) {
        /* @var AddonInterface $addon */
        $addon = $addons->findByNamespace($addon);

        if (!$authorizer->authorize(__FUNCTION__, $addon->getType())) {
            throw new \Exception('[' . __FUNCTION__ . '] command is not permitted.');
        }

        $console->call('addons:download', ['addon' => $addon->getName()]);
    }

    /**
     * Update an addon.
     *
     * @param AddonRepositoryInterface $addons
     * @param ComposerAuthorizer $authorizer
     * @param Kernel $console
     * @param $addon
     * @throws \Exception
     */
    public function update(
        AddonRepositoryInterface $addons,
        ComposerAuthorizer $authorizer,
        Kernel $console,
        $addon
    ) {
        /* @var AddonInterface $addon */
        $addon = $addons->findByNamespace($addon);

        if (!$authorizer->authorize(__FUNCTION__, $addon->getType())) {
            throw new \Exception('[' . __FUNCTION__ . '] command is not permitted.');
        }

        $addons->flushCache();

        $console->call('addons:update', ['addon' => $addon->getName()]);
    }

    /**
     * Remove an addon.
     *
     * @param AddonRepositoryInterface $addons
     * @param ComposerAuthorizer $authorizer
     * @param Kernel $console
     * @param $addon
     * @throws \Exception
     */
    public function remove(
        AddonRepositoryInterface $addons,
        ComposerAuthorizer $authorizer,
        Kernel $console,
        $addon
    ) {
        /* @var AddonInterface $addon */
        $addon = $addons->findByNamespace($addon);

        if (!$authorizer->authorize(__FUNCTION__, $addon->getType())) {
            throw new \Exception('[' . __FUNCTION__ . '] command is not permitted.');
        }

        $console->call('addons:remove', ['addon' => $addon->getName()]);
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
