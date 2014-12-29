<?php namespace Anomaly\Streams\Addon\Module\Addons;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class AddonsModulePluginFunctions
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Module\Addons
 */
class AddonsModulePluginFunctions
{

    /**
     * Get a module.
     *
     * @param null $module
     * @return null|Module
     */
    public function getModule($module = null)
    {
        if (!$module) {
            return app('streams.modules')->active()->getPresenter();
        }

        $module = app('streams.modules')->findBySlug($module);

        if (!$module instanceof Module) {
            return null;
        }

        return $module->getPresenter();
    }
}
