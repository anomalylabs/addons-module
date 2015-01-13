<?php namespace Anomaly\AddonsExtension\Extension;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class ExtensionRouteProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsExtension\Extension\Ui\Table
 */
class ExtensionRouteProvider extends RouteServiceProvider
{

    /**
     * Map routes for extensions.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        $router->any(
            'admin/addons/extensions',
            'Anomaly\AddonsModule\Http\Controller\Admin\ExtensionsController@index'
        );
    }
}
