<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Extension\Table\ExtensionTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class ExtensionsController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Http\Controller\Admin
 */
class ExtensionsController extends AdminController
{

    /**
     * Return an index of existing extensions.
     *
     * @param ExtensionTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ExtensionTableBuilder $table)
    {
        return $table->render();
    }
}
