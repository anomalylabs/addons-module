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
     * Return a desired module. If none provided
     * then return the active one.
     *
     * @param null $module
     * @return null|Module
     */
    public function module($module = null)
    {
        if (!$module) {
            return $this->modules->active();
        }

        $this->modules->findBySlug($module);
    }

    /**
     * Return modules collection.
     *
     * @return ModuleCollection
     */
    public function modules()
    {
        return $this->modules;
    }
}
