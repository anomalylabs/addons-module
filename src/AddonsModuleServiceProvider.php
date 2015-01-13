<?php namespace Anomaly\AddonsModule;

use Illuminate\Support\ServiceProvider;

/**
 * Class AddonsModuleServiceProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule
 */
class AddonsModuleServiceProvider extends ServiceProvider
{

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        app('twig')->addExtension(app('Anomaly\AddonsModule\AddonsModulePlugin'));
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->register('Anomaly\AddonsModule\Block\BlockRouteProvider');
        $this->app->register('Anomaly\AddonsModule\Theme\ThemeRouteProvider');
        $this->app->register('Anomaly\AddonsModule\Module\ModuleRouteProvider');
        $this->app->register('Anomaly\AddonsModule\Plugin\PluginRouteProvider');
        $this->app->register('Anomaly\AddonsModule\Extension\ExtensionRouteProvider');
        $this->app->register('Anomaly\AddonsModule\FieldType\FieldTypeRouteProvider');
        $this->app->register('Anomaly\AddonsModule\Distribution\DistributionRouteProvider');
    }
}
