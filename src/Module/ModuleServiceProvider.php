<?php namespace Anomaly\AddonsModule\Module;

use Illuminate\Support\ServiceProvider;

/**
 * Class ModuleServiceProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Module
 */
class ModuleServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('Anomaly\AddonsModule\Module\ModuleRouteProvider');
    }
}
