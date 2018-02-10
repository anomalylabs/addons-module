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
        'admin/addons/{type}/enable/{id}'                   => [
            'as'   => 'anomaly.module.addons::addon.enable',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@enable',
        ],
        'admin/addons/{type}/disable/{id}'                  => [
            'as'   => 'anomaly.module.addons::addon.disable',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@disable',
        ],
        'admin/addons/{type}/install/{id}'                  => [
            'as'   => 'anomaly.module.addons::addon.install',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@install',
        ],
        'admin/addons/{type}/options/{id}'                  => [
            'as'   => 'anomaly.module.addons::addon.options',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@options',
        ],
        'admin/addons/{type}/uninstall/{id}'                => [
            'as'   => 'anomaly.module.addons::addon.uninstall',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@uninstall',
        ],
        'admin/addons/{type}/view/{repository}/{addon}'     => [
            'as'   => 'anomaly.module.addons::addon.view',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@view',
        ],
        'admin/addons/{type}/remove/{repository}/{addon}'   => [
            'as'   => 'anomaly.module.addons::addon.remove',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@remove',
        ],
        'admin/addons/{type}/update/{repository}/{addon}'   => [
            'as'   => 'anomaly.module.addons::addon.update',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@update',
        ],
        'admin/addons/{type}/download/{repository}/{addon}' => [
            'as'   => 'anomaly.module.addons::addon.download',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@download',
        ],
        'admin/addons'                                      => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@index',
        'admin/addons/{type}'                               => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@index',
    ];

}
