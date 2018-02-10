<?php namespace Anomaly\AddonsModule\Addon\Table;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class AddonTableButtons
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonTableButtons
{

    /**
     * Handle the buttons.
     *
     * @param AddonTableBuilder $builder
     * @param AddonCollection   $addons
     */
    public function handle(AddonTableBuilder $builder, AddonCollection $addons)
    {
        $view = $builder->getActiveTableView();

        $builder->setButtons(
            [
                'view' => [
                    'href' => '/{request.path}/view/' . $view->getSlug() . '/{entry.id}',
                ],
            ]
        );

        $view = $builder->getActiveTableView();

        if ($view->getSlug() == 'downloaded') {
            $builder->addbuttons(
                [
                    'install'   => [
                        'data-toggle' => 'modal',
                        'data-target' => '#modal',
                        'permission'  => 'anomaly.module.addons::{entry.type}.manage',
                        'href'        => 'admin/addons/{entry.type}/options/{entry.id}',
                        'enabled'     => function ($entry) use ($addons) {

                            if (!in_array($entry['type'], ['module', 'extension'])) {
                                return false;
                            }

                            /* @var Module|Extension $addon */
                            if (!$addon = $addons->get($entry['id'])) {
                                return false;
                            }

                            return !$addon->isInstalled();
                        },
                    ],
                    'uninstall' => [
                        'button'       => 'uninstall',
                        'data-match'   => 'entry.name',
                        'icon'         => 'times-circle',
                        'permission'   => 'anomaly.module.addons::{entry.type}.manage',
                        'href'         => 'admin/addons/{entry.type}/uninstall/{entry.id}',
                        'text'         => 'anomaly.module.addons::button.uninstall',
                        'data-title'   => 'anomaly.module.addons::confirm.uninstall_title',
                        'data-message' => 'anomaly.module.addons::confirm.uninstall_message',
                        'enabled'      => function ($entry) use ($addons) {

                            if (!in_array($entry['type'], ['module', 'extension'])) {
                                return false;
                            }

                            /* @var Module|Extension $addon */
                            if (!$addon = $addons->get($entry['id'])) {
                                return false;
                            }

                            return $addon->isInstalled();
                        },
                    ],
                    'enable'    => [
                        'type'       => 'success',
                        'icon'       => 'fa fa-toggle-on',
                        'permission' => 'anomaly.module.addons::{entry.type}.manage',
                        'href'       => 'admin/addons/{entry.type}/enable/{entry.id}',
                        'enabled'    => function ($entry) use ($addons) {

                            if (!in_array($entry['type'], ['module', 'extension'])) {
                                return false;
                            }

                            /* @var Module|Extension $addon */
                            if (!$addon = $addons->get($entry['id'])) {
                                return false;
                            }

                            if (!$addon->isInstalled()) {
                                return false;
                            }

                            return !$addon->isEnabled();
                        },
                    ],
                    'disable'   => [
                        'type'         => 'warning',
                        'data-icon'    => 'warning',
                        'data-toggle'  => 'confirm',
                        'icon'         => 'fa fa-toggle-off',
                        'text'         => 'anomaly.module.addons::button.disable',
                        'permission'   => 'anomaly.module.addons::{entry.type}.manage',
                        'href'         => 'admin/addons/{entry.type}/disable/{entry.id}',
                        'data-title'   => 'anomaly.module.addons::confirm.disable_title',
                        'data-message' => 'anomaly.module.addons::confirm.disable_message',
                        'enabled'      => function ($entry) use ($addons) {

                            if (!in_array($entry['type'], ['module', 'extension'])) {
                                return false;
                            }

                            /* @var Module|Extension $addon */
                            if (!$addon = $addons->get($entry['id'])) {
                                return false;
                            }

                            if (!$addon->isInstalled()) {
                                return false;
                            }

                            return $addon->isEnabled();
                        },
                    ],
                ]
            );
        }
    }
}
