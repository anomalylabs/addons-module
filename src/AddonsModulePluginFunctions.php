<?php namespace Anomaly\AddonsModule;

use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;

/**
 * Class AddonsModulePluginFunctions
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule
 */
class AddonsModulePluginFunctions
{

    /**
     * The loaded modules.
     *
     * @var \Anomaly\Streams\Platform\Addon\Module\ModuleCollection
     */
    protected $modules;

    /**
     * Create a new BuildThemeNavigationCommandHandler instance.
     *
     * @param ModuleCollection $modules
     */
    public function __construct(ModuleCollection $modules)
    {
        $this->modules = $modules;
    }

    /**
     * Get a module.
     *
     * @param null $module
     * @return null|Module
     */
    public function getModule($module = null)
    {
        if (!$module) {
            $module = $this->modules->active();
        } else {
            $module = $this->modules->findBySlug($module);
        }

        if (!$module instanceof Module) {
            return null;
        }

        return $module->getPresenter();
    }
}
