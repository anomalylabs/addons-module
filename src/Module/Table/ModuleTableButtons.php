<?php namespace Anomaly\AddonsModule\Module\Table;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class ModuleTableButtons
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Module\Table
 */
class ModuleTableButtons
{

    /**
     * Return the table buttons.
     */
    public function handle(ModuleTableBuilder $builder)
    {
        $builder->setButtons(
            [
                [
                    'icon'       => 'question-circle',
                    'href'       => function (Module $entry) {
                        return '/admin/addons/modules/readme/' . $entry->getNamespace();
                    },
                    'attributes' => [
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-lg'
                    ]
                ],
                [
                    'type'       => function (Module $entry) {

                        if ($entry->isInstalled()) {
                            return 'danger';
                        }

                        return 'success';
                    },
                    'text'       => function (Module $entry) {

                        if ($entry->isInstalled()) {

                            return trans('module::button.uninstall');
                        }

                        return trans('module::button.install');
                    },
                    'attributes' => [
                        'href' => function (Module $entry) {

                            if ($entry->isInstalled()) {

                                return url('admin/addons/modules/uninstall/' . $entry->getSlug());
                            }

                            return url('admin/addons/modules/install/' . $entry->getSlug());
                        }
                    ],
                ]
            ]
        );
    }
}
