<?php namespace Anomaly\AddonsModule\Addon\Table;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class AddonTableButtons
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Addon\Table
 */
class AddonTableButtons implements SelfHandling
{

    /**
     * Handle the command.
     *
     * @param AddonTableBuilder $builder
     */
    public function handle(AddonTableBuilder $builder)
    {
        $builder->setButtons(
            [
                'install'   => [
                    'enabled' => function (Addon $entry) {

                        if (!$entry instanceof Module && !$entry instanceof Extension) {
                            return false;
                        }

                        return !$entry->isInstalled();
                    }
                ],
                'uninstall' => [
                    'enabled' => function (Addon $entry) {

                        if (!$entry instanceof Module && !$entry instanceof Extension) {
                            return false;
                        }

                        return $entry->isInstalled();
                    }
                ]
            ]
        );
    }
}
