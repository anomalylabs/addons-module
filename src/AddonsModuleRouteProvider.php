<?php namespace Anomaly\AddonsModule;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class AddonsModuleRouteProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule
 */
class AddonsModuleRouteProvider extends RouteServiceProvider
{

    /**
     * Map routes for blocks.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        // Block routes.
        $router->any(
            'admin/addons/blocks',
            'Anomaly\AddonsModule\Http\Controller\Admin\BlocksController@index'
        );

        // Distribution routes.
        $router->any(
            'admin/addons/distributions',
            'Anomaly\AddonsModule\Http\Controller\Admin\DistributionsController@index'
        );

        $router->get(
            'admin/addons/distributions/readme/{distribution}',
            'Anomaly\AddonsModule\Http\Controller\Admin\DistributionsController@readme'
        );

        // Extension routes.
        $router->any(
            'admin/addons/extensions',
            'Anomaly\AddonsModule\Http\Controller\Admin\ExtensionsController@index'
        );

        $router->get(
            'admin/addons/extensions/install/{extension}',
            'Anomaly\AddonsModule\Http\Controller\Admin\ExtensionsController@install'
        );

        $router->get(
            'admin/addons/extensions/uninstall/{extension}',
            'Anomaly\AddonsModule\Http\Controller\Admin\ExtensionsController@uninstall'
        );

        $router->get(
            'admin/addons/extensions/readme/{extension}',
            'Anomaly\AddonsModule\Http\Controller\Admin\ExtensionsController@readme'
        );

        // Field type routes.
        $router->any(
            'admin/addons/field_types',
            'Anomaly\AddonsModule\Http\Controller\Admin\FieldTypesController@index'
        );

        $router->get(
            'admin/addons/field_types/readme/{fieldType}',
            'Anomaly\AddonsModule\Http\Controller\Admin\FieldTypesController@readme'
        );

        // Module routes.
        $router->get(
            'admin/addons',
            'Anomaly\AddonsModule\Http\Controller\Admin\ModulesController@redirect'
        );

        $router->any(
            'admin/addons/modules',
            'Anomaly\AddonsModule\Http\Controller\Admin\ModulesController@index'
        );

        $router->get(
            'admin/addons/modules/install/{module}',
            'Anomaly\AddonsModule\Http\Controller\Admin\ModulesController@install'
        );

        $router->get(
            'admin/addons/modules/uninstall/{module}',
            'Anomaly\AddonsModule\Http\Controller\Admin\ModulesController@uninstall'
        );

        $router->get(
            'admin/addons/modules/readme/{module}',
            'Anomaly\AddonsModule\Http\Controller\Admin\ModulesController@readme'
        );

        // Plugin routes.
        $router->any(
            'admin/addons/plugins',
            'Anomaly\AddonsModule\Http\Controller\Admin\PluginsController@index'
        );

        $router->get(
            'admin/addons/plugins/readme/{plugin}',
            'Anomaly\AddonsModule\Http\Controller\Admin\PluginsController@readme'
        );

        // Theme routes.
        $router->any(
            'admin/addons/themes',
            'Anomaly\AddonsModule\Http\Controller\Admin\ThemesController@index'
        );

        $router->get(
            'admin/addons/themes/readme/{theme}',
            'Anomaly\AddonsModule\Http\Controller\Admin\ThemesController@readme'
        );
    }
}
