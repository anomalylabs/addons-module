<?php namespace Anomaly\AddonsModule\Addon\Table;

use Anomaly\AddonsModule\Addon\Contract\AddonInterface;
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
     */
    public function handle(AddonTableBuilder $builder)
    {
        $builder->setButtons(
            [
                'view' => [
                    'href' => '/{request.path}/view/{entry.namespace}',
                ],
            ]
        );

        $builder->addbuttons(
            [
                'install'   => [
                    'href'         => 'admin/addons/install/{entry.namespace}',
                    'data-message' => function (AddonInterface $entry) {
                        return trans('anomaly.module.addons::message.installing', ['addon' => $entry->getName()]);
                    },
                    'class'        => 'btn btn-success',
                    'data-toggle'  => 'prompts',
                    'enabled'      => function (AddonInterface $entry) {

                        if (!in_array($entry->getType(), ['module', 'extension'])) {
                            return false;
                        }

                        /* @var Module|Extension $addon */
                        if (!$addon = $entry->instance()) {
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
                    'href'         => 'admin/addons/uninstall/{entry.namespace}',
                    'text'         => 'anomaly.module.addons::button.uninstall',
                    'data-title'   => 'anomaly.module.addons::confirm.uninstall_title',
                    'data-message' => 'anomaly.module.addons::confirm.uninstall_message',
                    'enabled'      => function (AddonInterface $entry) {

                        if (!in_array($entry->getType(), ['module', 'extension'])) {
                            return false;
                        }

                        /* @var Module|Extension $addon */
                        if (!$addon = $entry->instance()) {
                            return false;
                        }

                        return $addon->isInstalled();
                    },
                ],
                'enable'    => [
                    'type'       => 'success',
                    'icon'       => 'fa fa-toggle-on',
                    'permission' => 'anomaly.module.addons::{entry.type}.manage',
                    'href'       => 'admin/addons/enable/{entry.namespace}',
                    'enabled'    => function (AddonInterface $entry) {

                        if (!in_array($entry->getType(), ['module', 'extension'])) {
                            return false;
                        }

                        /* @var Module|Extension $addon */
                        if (!$addon = $entry->instance()) {
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
                    'href'         => 'admin/addons/disable/{entry.namespace}',
                    'data-title'   => 'anomaly.module.addons::confirm.disable_title',
                    'data-message' => 'anomaly.module.addons::confirm.disable_message',
                    'enabled'      => function (AddonInterface $entry) {

                        if (!in_array($entry->getType(), ['module', 'extension'])) {
                            return false;
                        }

                        /* @var Module|Extension $addon */
                        if (!$addon = $entry->instance()) {
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
