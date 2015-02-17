<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Extension\Table\ExtensionTableBuilder;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionManager;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class ExtensionsController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Extension\Addons\Http\Controllers\Admin
 */
class ExtensionsController extends AdminController
{

    /**
     * Return an index of existing modules.
     *
     * @param \Anomaly\AddonsModule\Extension\Table\ExtensionTableBuilder $table
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function index(ExtensionTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Install a module.
     *
     * @param ExtensionManager $extensions
     * @param                  $slug
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function install(ExtensionManager $extensions, $slug)
    {
        $extensions->install($slug);

        return redirect()->back();
    }

    /**
     * Uninstall a module.
     *
     * @param ExtensionManager $extensions
     * @param                  $slug
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function uninstall(ExtensionManager $extensions, $slug)
    {
        $extensions->uninstall($slug);

        return redirect()->back();
    }

    /**
     * Output the readme for a extension.
     *
     * @param                     $extension
     * @param ExtensionCollection $extensions
     * @return \Illuminate\View\View
     */
    public function readme($extension, ExtensionCollection $extensions)
    {
        $addon = $extensions->get($extension);

        $readme = $addon->getPath('README.md');

        if (file_exists($readme)) {
            $readme = file_get_contents($readme);
        }

        return view('module::admin/modals/readme', compact('addon', 'readme'));
    }
}
