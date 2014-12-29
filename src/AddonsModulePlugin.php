<?php namespace Anomaly\Streams\Addon\Module\Addons;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;

/**
 * Class AddonsModulePlugin
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Module\Addons
 */
class AddonsModulePlugin extends Plugin
{

    /**
     * The functions handler for this plugin.
     *
     * @var AddonsModulePluginFunctions
     */
    protected $functions;

    /**
     * Create a new AddonsModulePlugin instance.
     *
     * @param AddonsModulePluginFunctions $functions
     */
    public function __construct(AddonsModulePluginFunctions $functions)
    {
        $this->functions = $functions;
    }

    /**
     * Return functions to allow interaction
     * with the addons module and it's features.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('get_module', [$this->functions, 'getModule']),
        ];
    }
}
