<?php namespace Anomaly\AddonsModule;

use Anomaly\AddonsModule\Addon\AddonRepository;
use Anomaly\AddonsModule\Addon\Contract\AddonRepositoryInterface;
use Anomaly\AddonsModule\Composer\ComposerAuthorizer;
use Anomaly\AddonsModule\Console\Download;
use Anomaly\AddonsModule\Console\Remove;
use Anomaly\AddonsModule\Console\Show;
use Anomaly\AddonsModule\Console\Sync;
use Anomaly\AddonsModule\Console\Update;
use Anomaly\AddonsModule\Listener\RefreshAddonsModule;
use Anomaly\AddonsModule\Repository\Contract\RepositoryRepositoryInterface;
use Anomaly\AddonsModule\Repository\RepositoryRepository;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Application\Event\SystemIsRefreshing;

/**
 * Class AddonsModuleServiceProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonsModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon commands.
     *
     * @var array
     */
    protected $commands = [
        Show::class,
        Sync::class,
        Remove::class,
        Update::class,
        Download::class,
    ];

    /**
     * The addon plugins.
     *
     * @var array
     */
    protected $plugins = [
        AddonsModulePlugin::class,
    ];

    /**
     * The addon listeners.
     *
     * @var array
     */
    protected $listeners = [
        SystemIsRefreshing::class => [
            RefreshAddonsModule::class,
        ],
    ];

    /**
     * The addon singletons.
     *
     * @var array
     */
    protected $singletons = [
        AddonRepositoryInterface::class      => AddonRepository::class,
        ComposerAuthorizer::class            => ComposerAuthorizer::class,
        RepositoryRepositoryInterface::class => RepositoryRepository::class,
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'admin/addons/enable/{addon}'    => [
            'as'   => 'anomaly.module.addons::addons.enable',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@enable',
        ],
        'admin/addons/disable/{addon}'   => [
            'as'   => 'anomaly.module.addons::addons.disable',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@disable',
        ],
        'admin/addons/install/{addon}'   => [
            'as'   => 'anomaly.module.addons::addons.install',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@install',
        ],
        'admin/addons/uninstall/{addon}' => [
            'as'   => 'anomaly.module.addons::addons.uninstall',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@uninstall',
        ],
        'admin/addons/migrate/{addon}'   => [
            'as'   => 'anomaly.module.addons::addons.migrate',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@migrate',
        ],
        'admin/addons/view/{addon}'      => [
            'as'   => 'anomaly.module.addons::addons.view',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@view',
        ],
        'admin/addons/remove/{addon}'    => [
            'as'   => 'anomaly.module.addons::composer.remove',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@remove',
        ],
        'admin/addons/update/{addon}'    => [
            'as'   => 'anomaly.module.addons::composer.update',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@update',
        ],
        'admin/addons/download/{addon}'  => [
            'as'   => 'anomaly.module.addons::composer.download',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@download',
        ],
    ];

}
