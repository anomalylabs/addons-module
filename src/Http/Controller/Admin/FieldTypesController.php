<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Ui\Table\FieldType\FieldTypeTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class FieldTypesController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Theme\Addons\Http\Controllers\Admin
 */
class FieldTypesController extends AdminController
{

    /**
     * Return an index of existing field types.
     *
     * @param FieldTypeTableBuilder $table
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function index(FieldTypeTableBuilder $table)
    {
        return $table->render();
    }
}
