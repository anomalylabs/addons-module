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

        'admin/addons/blocks'                              =>
            'Anomaly\AddonsModule\Http\Controller\Admin\BlocksController@index',
        'admin/addons/distributions'                       =>
            'Anomaly\AddonsModule\Http\Controller\Admin\DistributionsController@index',
        'admin/addons/distributions/readme/{distribution}' =>
            'Anomaly\AddonsModule\Http\Controller\Admin\DistributionsController@readme',
        'admin/addons/extensions'                          =>
            'Anomaly\AddonsModule\Http\Controller\Admin\ExtensionsController@index',
        'admin/addons/extensions/install/{extension}'      =>
            'Anomaly\AddonsModule\Http\Controller\Admin\ExtensionsController@install',
        'admin/addons/extensions/uninstall/{extension}'    =>
            'Anomaly\AddonsModule\Http\Controller\Admin\ExtensionsController@uninstall',
        'admin/addons/extensions/readme/{extension}'       =>
            'Anomaly\AddonsModule\Http\Controller\Admin\ExtensionsController@readme',
        'admin/addons/field_types'                         =>
            'Anomaly\AddonsModule\Http\Controller\Admin\FieldTypesController@index',
        'admin/addons/field_types/readme/{fieldType}'      =>
            'Anomaly\AddonsModule\Http\Controller\Admin\FieldTypesController@readme',
        'admin/addons'                                     =>
            'Anomaly\AddonsModule\Http\Controller\Admin\ModulesController@redirect',
        'admin/addons/modules'                             =>
            'Anomaly\AddonsModule\Http\Controller\Admin\ModulesController@index',
        'admin/addons/modules/install/{module}'            =>
            'Anomaly\AddonsModule\Http\Controller\Admin\ModulesController@install',
        'admin/addons/modules/uninstall/{module}'          =>
            'Anomaly\AddonsModule\Http\Controller\Admin\ModulesController@uninstall',
        'admin/addons/modules/readme/{module}'             =>
            'Anomaly\AddonsModule\Http\Controller\Admin\ModulesController@readme',
        'admin/addons/plugins'                             =>
            'Anomaly\AddonsModule\Http\Controller\Admin\PluginsController@index',
        'admin/addons/plugins/readme/{plugin}'             =>
            'Anomaly\AddonsModule\Http\Controller\Admin\PluginsController@readme',
        'admin/addons/themes'                              =>
            'Anomaly\AddonsModule\Http\Controller\Admin\ThemesController@index',
        'admin/addons/themes/readme/{theme}'               =>
            'Anomaly\AddonsModule\Http\Controller\Admin\ThemesController@readme',
    ];

}
