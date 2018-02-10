<?php namespace Anomaly\AddonsModule;

use Anomaly\AddonsModule\Composer\Command\GetComposerAuthorization;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;

/**
 * Class AddonsModulePlugin
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonsModulePlugin extends Plugin
{

    /**
     * Get the functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'composer_can',
                function ($command, $type) {
                    return $this->dispatch(new GetComposerAuthorization($command, $type));
                }
            ),
        ];
    }
}
