<?php namespace Anomaly\AddonsModule\Plugin\Ui\Table;

use Anomaly\AddonsModule\Ui\Table\Plugin\PluginTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class PluginsController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Theme\Addons\Http\Controllers\Admin
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
}
