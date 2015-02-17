<?php namespace Anomaly\AddonsModule\Distribution;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class DistributionRouteProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsDistribution\Distribution\Table
 */
class DistributionRouteProvider extends RouteServiceProvider
{

    /**
     * Map routes for distributions.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        $router->any(
            'admin/addons/distributions',
            'Anomaly\AddonsModule\Http\Controller\Admin\DistributionsController@index'
        );
    }
}
