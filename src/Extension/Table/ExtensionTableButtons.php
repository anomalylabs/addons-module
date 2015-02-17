<?php namespace Anomaly\AddonsModule\Extension\Table;

use Anomaly\Streams\Platform\Addon\Extension\Extension;

/**
 * Class ExtensionTableButtons
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Module\Table
 */
class ExtensionTableButtons
{

    /**
     * Handle table buttons.
     *
     * @param ExtensionTableBuilder $builder
     */
    public function handle(ExtensionTableBuilder $builder)
    {
        $builder->setButtons(
            [
                [
                    'icon'       => 'question-circle',
                    'href'       => function (Extension $entry) {
                        return '/admin/addons/extensions/readme/' . $entry->getNamespace();
                    },
                    'attributes' => [
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-lg'
                    ]
                ],
                [
                    'type'       => function (Extension $entry) {

                        if ($entry->isInstalled()) {

                            return 'danger';
                        }

                        return 'success';
                    },
                    'text'       => function (Extension $entry) {

                        if ($entry->isInstalled()) {

                            return trans('module::button.uninstall');
                        }

                        return trans('module::button.install');
                    },
                    'attributes' => [
                        'href' => function (Extension $entry) {

                            if ($entry->isInstalled()) {

                                return url('admin/addons/extensions/uninstall/' . $entry->getSlug());
                            }

                            return url('admin/addons/extensions/install/' . $entry->getSlug());
                        }
                    ]
                ]
            ]
        );
    }
}
