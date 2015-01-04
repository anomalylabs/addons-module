<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Ui\Table\Distribution\DistributionTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class DistributionsController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Theme\Addons\Http\Controllers\Admin
 */
class DistributionsController extends AdminController
{

    /**
     * Return an index of existing distributions.
     *
     * @param DistributionTableBuilder $table
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function index(DistributionTableBuilder $table)
    {
        return $table->render();
    }
}
