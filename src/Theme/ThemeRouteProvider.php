<?php namespace Anomaly\AddonsModule\Theme;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class ThemeRouteProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Theme\Table
 */
class ThemeRouteProvider extends RouteServiceProvider
{

    /**
     * Map routes for themes.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        $router->any(
            'admin/addons/themes',
            'Anomaly\AddonsModule\Http\Controller\Admin\ThemesController@index'
        );
    }
}
