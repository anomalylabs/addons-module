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
        'admin/addons/{type?}'           => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@index',
        'admin/addons/details/{type?}'   => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@details',
        'admin/addons/install/{type?}'   => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@install',
        'admin/addons/migrate/{type?}'   => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@migrate',
        'admin/addons/options/{type?}'   => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@options',
        'admin/addons/uninstall/{type?}' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@uninstall',
    ];

}
