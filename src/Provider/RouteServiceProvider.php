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

        $this->registerModuleRoutes($router);
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
    }
}
 