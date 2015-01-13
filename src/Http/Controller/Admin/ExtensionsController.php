<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Extension\Ui\Table\ExtensionTableBuilder;
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
     * @param \Anomaly\AddonsModule\Extension\Ui\Table\ExtensionTableBuilder $table
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function index(ExtensionTableBuilder $table)
    {
        return $table->render();
    }
}
