<?php namespace Anomaly\AddonsModule\Ui\Table\Module\Handler;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class ButtonHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Ui\Table\Module
 */
class ButtonHandler
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

                            return trans('streams::button.uninstall');
                        }

                        return trans('streams::button.install');
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
