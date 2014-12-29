<?php namespace Anomaly\Streams\Addon\Module\Addons;

use Illuminate\Support\ServiceProvider;

/**
 * Class AddonsModuleServiceProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Module\Addons
 */
class AddonsModuleServiceProvider extends ServiceProvider
{

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        app('twig')->addExtension(app('Anomaly\Streams\Addon\Module\Addons\AddonsModulePlugin'));
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->register('Anomaly\Streams\Addon\Module\Addons\Provider\RouteServiceProvider');
    }
}
 