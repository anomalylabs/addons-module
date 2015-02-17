<?php namespace Anomaly\AddonsModule\Module;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class ModuleRouteProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Module\Table
 */
class ModuleRouteProvider extends RouteServiceProvider
{

    /**
     * Map routes for modules.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        $router->get(
            'admin/addons',
            function () {
                return redirect('admin/addons/modules');
            }
        );

        $router->any(
            'admin/addons/modules',
            'Anomaly\AddonsModule\Http\Controller\Admin\ModulesController@index'
        );

        $router->get(
            'admin/addons/modules/install/{slug}',
            'Anomaly\AddonsModule\Http\Controller\Admin\ModulesController@install'
        );

        $router->get(
            'admin/addons/modules/uninstall/{slug}',
            'Anomaly\AddonsModule\Http\Controller\Admin\ModulesController@uninstall'
        );

        $router->get(
            'admin/addons/modules/readme/{module}',
            'Anomaly\AddonsModule\Http\Controller\Admin\ModulesController@readme'
        );
    }
}
