<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Ui\Table\BlockTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class BlocksController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Extension\Addons\Http\Controllers\Admin
 */
class BlocksController extends AdminController
{

    /**
     * Return an index of existing blocks.
     *
     * @param BlockTableBuilder $table
     * @return mixed|null
     */
    public function index(BlockTableBuilder $table)
    {
        return $table->render();
    }
}
