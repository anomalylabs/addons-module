<?php namespace Anomaly\AddonsModule\Http\Middleware;

use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Asset\Asset;
use Closure;
use Illuminate\Http\Request;

/**
 * Class MonitorComposerLog
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class MonitorComposerLog
{

    /**
     * The asset manager.
     *
     * @var Asset
     */
    protected $asset;

    /**
     * The application instance.
     *
     * @var Application
     */
    protected $application;

    /**
     * Create a new MonitorComposerLog instance.
     *
     * @param Asset $asset
     * @param Application $application
     */
    public function __construct(
        Asset $asset,
        Application $application
    ) {
        $this->asset       = $asset;
        $this->application = $application;
    }

    /**
     * Check for and set namespace if present.
     *
     * @param  Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (file_exists($log = $this->application->getAssetsPath('process.log'))) {
            $this->asset->add('scripts.js', 'anomaly.module.addons::js/monitor.js');
        }

        return $next($request);
    }
}
