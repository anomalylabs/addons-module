<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Addon\Table\AddonTableBuilder;
use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\Extension\Command\InstallExtension;
use Anomaly\Streams\Platform\Addon\Extension\Command\UninstallExtension;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Module\Command\InstallModule;
use Anomaly\Streams\Platform\Addon\Module\Command\UninstallModule;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Message\MessageBag;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Routing\Redirector;

/**
 * Class AddonsController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Http\Controller\Admin
 */
class AddonsController extends AdminController
{

    /**
     * Return an index of existing addons.
     *
     * @param AddonTableBuilder $table
     * @param Redirector        $redirector
     * @param null              $type
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function index(AddonTableBuilder $table, Redirector $redirector, $type = null)
    {
        if (!$type) {
            return $redirector->to('admin/addons/modules');
        }

        return $table->setOption('addon_type', $type)->render();
    }

    /**
     * Show the details of an addon.
     *
     * @param AddonCollection $addons
     * @param                 $type
     * @param                 $namespace
     * @return string
     */
    public function show(AddonCollection $addons, $type, $namespace)
    {
        /* @var Addon $addon */
        $addon = $addons->{$type}->get($namespace);

        $json = $addon->getComposerJson();

        if (file_exists($readme = $addon->getPath('README.md'))) {
            $readme = file_get_contents($readme);
        }

        if (file_exists($license = $addon->getPath('LICENSE.md'))) {
            $license = file_get_contents($license);
        }

        return view('module::admin/addon', compact('addon', 'json', 'readme', 'license'))->render();
    }

    /**
     * Install a module or extension.
     *
     * @param AddonCollection $addons
     * @param MessageBag      $messages
     * @param Redirector      $redirector
     * @param                 $type
     * @param                 $namespace
     * @return \Illuminate\Http\RedirectResponse
     */
    public function install(AddonCollection $addons, MessageBag $messages, Redirector $redirector, $type, $namespace)
    {
        /* @var Addon $addon */
        $addon = $addons->{$type}->get($namespace);

        if ($addon instanceof Module) {

            $this->dispatch(new InstallModule($addon, true));

            $messages->success(
                trans(
                    'module::message.install_module_success',
                    ['module' => strtolower(trans($addon->getName()))]
                )
            );
        } elseif ($addon instanceof Extension) {

            $this->dispatch(new InstallExtension($addon, true));

            $messages->success(
                trans(
                    'module::message.install_extension_success',
                    ['extension' => strtolower(trans($addon->getName()))]
                )
            );
        }

        return $redirector->back();
    }

    /**
     * Uninstall a module or extension.
     *
     * @param AddonCollection $addons
     * @param MessageBag      $messages
     * @param Redirector      $redirector
     * @param                 $type
     * @param                 $namespace
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uninstall(AddonCollection $addons, MessageBag $messages, Redirector $redirector, $type, $namespace)
    {
        /* @var Addon $addon */
        $addon = $addons->{$type}->get($namespace);

        if ($addon instanceof Module) {

            $this->dispatch(new UninstallModule($addon));

            $messages->success(
                trans(
                    'module::message.uninstall_module_success',
                    ['module' => strtolower(trans($addon->getName()))]
                )
            );
        } elseif ($addon instanceof Extension) {

            $this->dispatch(new UninstallExtension($addon, true));

            $messages->success(
                trans(
                    'module::message.uninstall_extension_success',
                    ['extension' => strtolower(trans($addon->getName()))]
                )
            );
        }

        return $redirector->back();
    }

    /**
     * Delete an addon.
     *
     * @param AddonCollection $addons
     * @param MessageBag      $messages
     * @param Redirector      $redirector
     * @param Filesystem      $files
     * @param                 $type
     * @param                 $namespace
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(
        AddonCollection $addons,
        MessageBag $messages,
        Redirector $redirector,
        Filesystem $files,
        $type,
        $namespace
    ) {
        /* @var Addon $addon */
        $addon = $addons->{$type}->get($namespace);

        $messages->success(
            trans(
                'module::message.addon_delete_success',
                ['addon' => strtolower(trans($addon->getName()))]
            )
        );

        $files->deleteDirectory($addon->getPath());

        return $redirector->to('admin/addons/' . str_plural($addon->getType()));
    }
}
