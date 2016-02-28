<?php namespace Anomaly\AddonsModule\Addon\Table;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class AddonTableButtons
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
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
                'information' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/addons/details/{entry.namespace}'
                ],
                'install'     => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/addons/install/{entry.namespace}/options',
                    'enabled'     => function (Addon $entry) {

                        if (!$entry instanceof Module && !$entry instanceof Extension) {
                            return false;
                        }

                        return !$entry->isInstalled();
                    }
                ],
                'uninstall'   => [
                    'href'    => 'admin/addons/uninstall/{entry.namespace}',
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
