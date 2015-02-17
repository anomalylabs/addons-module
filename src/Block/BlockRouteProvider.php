<?php namespace Anomaly\AddonsModule\Block;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class BlockRouteProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsBlock\Block\Table
 */
class BlockRouteProvider extends RouteServiceProvider
{

    /**
     * Map routes for blocks.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        $router->any(
            'admin/addons/blocks',
            'Anomaly\AddonsModule\Http\Controller\Admin\BlocksController@index'
        );
    }
}
