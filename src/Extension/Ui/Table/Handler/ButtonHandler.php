<?php namespace Anomaly\AddonsModule\Extension\Ui\Table\Handler;

use Anomaly\Streams\Platform\Addon\Extension\Extension;

/**
 * Class ButtonHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Module\Table
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
                ],
            ]
        ];
    }
}
