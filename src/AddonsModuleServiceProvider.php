<?php namespace Anomaly\AddonsModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class AddonsModuleServiceProvider
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddonsModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'admin/addons/enable/{id}'               => [
            'as'   => 'anomaly.module.addons::addon.enable',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@enable',
        ],
        'admin/addons/disable/{id}'              => [
            'as'   => 'anomaly.module.addons::addon.disable',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@disable',
        ],
        'admin/addons/install/{id}'              => [
            'as'   => 'anomaly.module.addons::addon.install',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@install',
        ],
        'admin/addons/options/{id}'              => [
            'as'   => 'anomaly.module.addons::addon.options',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@options',
        ],
        'admin/addons/uninstall/{id}'            => [
            'as'   => 'anomaly.module.addons::addon.uninstall',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@uninstall',
        ],
        'admin/addons/view/{repository}/{addon}' => [
            'as'   => 'anomaly.module.addons::addon.view',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@view',
        ],
        'admin/addons/{type?}'                   => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@index',
    ];

}
