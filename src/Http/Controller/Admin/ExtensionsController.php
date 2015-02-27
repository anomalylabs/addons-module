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
     * The extension collection.
     *
     * @var ExtensionCollection
     */
    protected $extensions;

    /**
     * Create a new ExtensionsController instance.
     *
     * @param ExtensionCollection $extensions
     */
    public function __construct(ExtensionCollection $extensions)
    {
        parent::__construct();

        $this->extensions = $extensions;
    }

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
     * @param                  $extension
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function install(ExtensionManager $extensions, $extension)
    {
        $extensions->install($this->extensions->get($extension));

        return redirect()->back();
    }

    /**
     * Uninstall a module.
     *
     * @param ExtensionManager $extensions
     * @param                  $extension
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function uninstall(ExtensionManager $extensions, $extension)
    {
        $extensions->uninstall($this->extensions->get($extension));

        return redirect()->back();
    }

    /**
     * Output the readme for a extension.
     *
     * @param                     $extension
     * @param ExtensionCollection $extensions
     * @return \Illuminate\View\View
     */
    public function readme($extension)
    {
        $addon = $this->extensions->get($this->extensions->get($extension));

        $readme = $addon->getPath('README.md');

        if (file_exists($readme)) {
            $readme = file_get_contents($readme);
        }

        return view('module::admin/modals/readme', compact('addon', 'readme'));
    }
}
