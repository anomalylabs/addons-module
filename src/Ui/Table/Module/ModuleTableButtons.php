<?php namespace Anomaly\AddonsModule\Ui\Table\Module;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class ModuleTableButtons
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Ui\Table\Module
 */
class ModuleTableButtons
{

    /**
     * Handle table buttons.
     *
     * @return array
     */
    public function handle()
    {
        return [
            [
                'type'       => function (Module $entry) {

                        if ($entry->isInstalled()) {

                            return 'danger';
                        }

                        return 'success';
                    },
                'text'       => function (Module $entry) {

                        if ($entry->isInstalled()) {

                            return trans('button.uninstall');
                        }

                        return trans('button.install');
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
        ];
    }
}
