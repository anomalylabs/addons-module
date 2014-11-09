<?php namespace Anomaly\Streams\Addon\Module\Addons\Provider;

use Illuminate\Routing\Router;

class RouteServiceProvider extends \Illuminate\Foundation\Support\Providers\RouteServiceProvider
{

    /**
     * The controllers to scan for route annotations.
     *
     * @var array
     */
    protected $scan = [];

    /**
     * All of the module's route middleware keys.
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * Called before routes are registered.
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function before()
    {
        //
    }

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
        $this->registerTagRoutes($router);
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
            'Anomaly\Streams\Addon\Module\Addons\Http\Controller\Admin\ModulesController@index'
        );

        $router->any(
            'admin/addons/modules/install/{slug}',
            'Anomaly\Streams\Addon\Module\Addons\Http\Controller\Admin\ModulesController@install'
        );

        $router->any(
            'admin/addons/modules/uninstall/{slug}',
            'Anomaly\Streams\Addon\Module\Addons\Http\Controller\Admin\ModulesController@uninstall'
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
            'Anomaly\Streams\Addon\Module\Addons\Http\Controller\Admin\ThemesController@index'
        );
    }

    /**
     * Register tag routes.
     *
     * @param Router $router
     */
    private function registerTagRoutes(Router $router)
    {
        $router->any(
            'admin/addons/tags',
            'Anomaly\Streams\Addon\Module\Addons\Http\Controller\Admin\TagsController@index'
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
            'Anomaly\Streams\Addon\Module\Addons\Http\Controller\Admin\ExtensionsController@index'
        );
    }
}
 