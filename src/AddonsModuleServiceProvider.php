<?php namespace Anomaly\AddonsModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class AddonsModuleServiceProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule
 */
class AddonsModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon plugins.
     *
     * @var array
     */
    protected $plugins = [
        'Anomaly\AddonsModule\AddonsModulePlugin'
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'admin/addons/{type?}'                  => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@index',
        'admin/addons/{type}/{addon}'           => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@show',
        'admin/addons/{type}/enable/{addon}'    => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@enable',
        'admin/addons/{type}/disable/{addon}'   => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@disable',
        'admin/addons/{type}/install/{addon}'   => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@install',
        'admin/addons/{type}/uninstall/{addon}' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@uninstall',
        'admin/addons/{type}/delete/{addon}'    => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@delete'
    ];

}
