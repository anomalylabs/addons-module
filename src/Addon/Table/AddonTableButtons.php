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
        $builder->setButtons(
            [
                'view' => [
                    'href' => '/{request.path}/view/{entry.name}?repository={request.input.view}',
                ],
            ]
        );

        $view = $builder->getActiveTableView();

        if ($view->getSlug() !== 'downloaded') {

            $builder->addButton(
                'download',
                [
                    'target' => '_blank',
                    'type'   => 'primary',
                    'icon'   => 'download',
                    'text'   => 'Download',
                    'href'   => '/admin/addons/download?package={entry.name}',
                ]
            );
        }

        if ($view->getSlug() == 'downloaded') {
            $builder->addbuttons(
                [
                    'install'   => [
                        'data-toggle' => 'modal',
                        'data-target' => '#modal',
                        'href'        => 'admin/addons/options/{entry.namespace}',
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
                        'button'  => 'uninstall',
                        'icon'    => 'times-circle',
                        'text'    => 'anomaly.module.addons::button.uninstall',
                        'href'    => 'admin/addons/uninstall/{entry.namespace}',
                        'enabled' => function ($entry) use ($addons) {

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
                ]
            );
        }
    }
}
