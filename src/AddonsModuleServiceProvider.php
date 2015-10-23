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
        'admin/addons/{type?}'           => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@index',
        'admin/addons/details/{type?}'   => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@details',
        'admin/addons/install/{type?}'   => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@install',
        'admin/addons/uninstall/{type?}' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@uninstall'
    ];

}
