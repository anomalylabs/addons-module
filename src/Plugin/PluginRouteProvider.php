<?php namespace Anomaly\AddonsModule\Plugin;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class PluginRouteProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Plugin
 */
class PluginRouteProvider extends RouteServiceProvider
{

    /**
     * Map routes for plugins.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        $router->any(
            'admin/addons/plugins',
            'Anomaly\AddonsModule\Http\Controller\Admin\PluginsController@index'
        );
    }
}
