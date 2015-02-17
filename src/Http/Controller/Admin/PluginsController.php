<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Plugin\Table\PluginTableBuilder;
use Anomaly\Streams\Platform\Addon\Plugin\PluginCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class PluginsController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Plugin\Addons\Http\Controllers\Admin
 */
class PluginsController extends AdminController
{

    /**
     * Return an index of existing plugins.
     *
     * @param PluginTableBuilder $table
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function index(PluginTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Output the readme for a plugin.
     *
     * @param                  $plugin
     * @param PluginCollection $plugins
     * @return \Illuminate\View\View
     */
    public function readme($plugin, PluginCollection $plugins)
    {
        $addon = $plugins->get($plugin);

        $readme = $addon->getPath('README.md');

        if (file_exists($readme)) {
            $readme = file_get_contents($readme);
        }

        return view('module::admin/modals/readme', compact('addon', 'readme'));
    }
}
