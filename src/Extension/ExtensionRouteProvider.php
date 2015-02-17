<?php namespace Anomaly\AddonsModule\Extension;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class ExtensionRouteProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsExtension\Extension\Table
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
        $router->any(
            'admin/addons/extensions/install/{slug}',
            'Anomaly\AddonsModule\Http\Controller\Admin\ExtensionsController@install'
        );
        $router->any(
            'admin/addons/extensions/uninstall/{slug}',
            'Anomaly\AddonsModule\Http\Controller\Admin\ExtensionsController@uninstall'
        );
    }
}
