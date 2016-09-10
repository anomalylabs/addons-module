<?php namespace Anomaly\AddonsModule\Addon\Table;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Module\Module;


/**
 * Class AddonTableButtons
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddonTableButtons
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
                    'href'        => 'admin/addons/details/{entry.namespace}',
                ],
                'install'     => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/addons/options/{entry.namespace}',
                    'enabled'     => function (Addon $entry) {

                        if (!$entry instanceof Module && !$entry instanceof Extension) {
                            return false;
                        }

                        return !$entry->isInstalled();
                    },
                ],
                'uninstall'   => [
                    'button'     => 'prompt',
                    'href'       => 'admin/addons/uninstall/{entry.namespace}',
                    'data-match' => function (Addon $entry) {
                        return $entry->getTitle();
                    },
                    'enabled'    => function (Addon $entry) {

                        if (!$entry instanceof Module && !$entry instanceof Extension) {
                            return false;
                        }

                        return $entry->isInstalled();
                    },
                ],
            ]
        );
    }
}
