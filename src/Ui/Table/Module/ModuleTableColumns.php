<?php namespace Anomaly\AddonsModule\Ui\Table\Module;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class ModuleTableColumns
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Ui\Table\Module
 */
class ModuleTableColumns
{

    /**
     * Handle table columns.
     *
     * @return array
     */
    public function handle()
    {
        return [
            [
                'header' => 'module::admin.name',
                'value'  => function (Module $entry) {
                        return trans($entry->getName());
                    },
            ],
            [
                'header' => 'module::admin.description',
                'value'  => function (Module $entry) {
                        return trans($entry->getDescription());
                    },
            ],
            [
                'value' => function (Module $entry) {

                        if ($entry->isInstalled()) {

                            $class = 'success';
                            $label = trans('module::admin.installed');
                        } else {

                            $class = 'default';
                            $label = trans('module::admin.uninstalled');
                        }

                        return '<span class="label label-' . $class . '">' . $label . '</span>';
                    },
            ],
            [
                'value' => function (Module $entry) {

                        if ($entry->isCore()) {

                            return '<span class="label label-danger">' . trans('module::admin.core') . '</span>';
                        }
                    },
            ],
        ];
    }
}
