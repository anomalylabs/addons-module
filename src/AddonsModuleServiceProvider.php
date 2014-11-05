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
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('Anomaly\Streams\Addon\Module\Addons\Provider\RouteServiceProvider');
    }
}
 