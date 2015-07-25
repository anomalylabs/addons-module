<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Module\Table\ModuleTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class ModulesController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Http\Controller\Admin
 */
class ModulesController extends AdminController
{

    /**
     * Return an index of existing modules.
     *
     * @param ModuleTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ModuleTableBuilder $table)
    {
        return $table->render();
    }
}
