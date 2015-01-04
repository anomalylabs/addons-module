<?php namespace Anomaly\AddonsModule\Provider;

use Illuminate\Routing\Router;

/**
 * Class RouteServiceProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Provider
 */
class RouteServiceProvider extends \Illuminate\Foundation\Support\Providers\RouteServiceProvider
{

    /**
     * Define the routes for the module.
     *
     * @return void
     */
    public function map(Router $router)
    {
        $router->get(
            'admin/addons',
            function () {
                return redirect('admin/addons/modules');
            }
        );

        $this->registerExtensionRoutes($router);
        $this->registerModuleRoutes($router);
        $this->registerThemeRoutes($router);
        $this->registerBlockRoutes($router);
        $this->registerPluginRoutes($router);
    }

    /**
     * Register module routes.
     *
     * @param Router $router
     */
    protected function registerModuleRoutes(Router $router)
    {
        $router->any(
            'admin/addons/modules',
            'Anomaly\AddonsModule\Http\Controller\Admin\ModulesController@index'
        );
        $router->any(
            'admin/addons/modules/install/{slug}',
            'Anomaly\AddonsModule\Http\Controller\Admin\ModulesController@install'
        );
        $router->any(
            'admin/addons/modules/uninstall/{slug}',
            'Anomaly\AddonsModule\Http\Controller\Admin\ModulesController@uninstall'
        );
    }

    /**
     * Register theme routes.
     *
     * @param Router $router
     */
    private function registerThemeRoutes(Router $router)
    {
        $router->any(
            'admin/addons/themes',
            'Anomaly\AddonsModule\Http\Controller\Admin\ThemesController@index'
        );
    }

    /**
     * Register block routes.
     *
     * @param Router $router
     */
    protected function registerBlockRoutes(Router $router)
    {
        $router->any(
            'admin/addons/blocks',
            'Anomaly\AddonsModule\Http\Controller\Admin\BlocksController@index'
        );
    }

    /**
     * Register plugin routes.
     *
     * @param Router $router
     */
    private function registerPluginRoutes(Router $router)
    {
        $router->any(
            'admin/addons/plugins',
            'Anomaly\AddonsModule\Http\Controller\Admin\PluginsController@index'
        );
    }

    /**
     * Register extension routes.
     *
     * @param Router $router
     */
    private function registerExtensionRoutes(Router $router)
    {
        $router->any(
            'admin/addons/extensions',
            'Anomaly\AddonsModule\Http\Controller\Admin\ExtensionsController@index'
        );
    }
}
