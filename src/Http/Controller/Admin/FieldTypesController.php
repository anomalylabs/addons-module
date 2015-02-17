<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\FieldType\Table\FieldTypeTableBuilder;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class FieldTypesController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\FieldType\Addons\Http\Controllers\Admin
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

    /**
     * Output the readme for a field type.
     *
     * @param                     $field_type
     * @param FieldTypeCollection $field_types
     * @return \Illuminate\View\View
     */
    public function readme($field_type, FieldTypeCollection $field_types)
    {
        $addon = $field_types->get($field_type);

        $readme = $addon->getPath('README.md');

        if (file_exists($readme)) {
            $readme = file_get_contents($readme);
        }

        return view('module::admin/modals/readme', compact('addon', 'readme'));
    }
}
