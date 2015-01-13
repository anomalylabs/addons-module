<?php namespace Anomaly\AddonsModule\FieldType;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class FieldTypeRouteProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsFieldType\FieldType\Ui\Table
 */
class FieldTypeRouteProvider extends RouteServiceProvider
{

    /**
     * Map routes for field types.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        $router->any(
            'admin/addons/field_types',
            'Anomaly\AddonsModule\Http\Controller\Admin\FieldTypesController@index'
        );
    }
}
