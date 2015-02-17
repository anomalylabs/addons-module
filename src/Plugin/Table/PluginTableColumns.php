<?php namespace Anomaly\AddonsModule\Plugin\Table;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;

/**
 * Class PluginTableColumns
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Table\Plugin
 */
class PluginTableColumns
{

    /**
     * Handle the table columns.
     *
     * @param PluginTableBuilder $builder
     */
    public function handle(PluginTableBuilder $builder)
    {
        $builder->setColumns(
            [
                [
                    'heading' => 'streams::addon.plugin',
                    'value'   => function (Plugin $entry) {
                        return trans($entry->getName());
                    },
                ],
                [
                    'heading' => 'module::admin.description',
                    'value'   => function (Plugin $entry) {
                        return trans($entry->getDescription());
                    },
                ],
                [
                    'heading' => 'module::admin.location',
                    'value'   => function (Plugin $entry) {

                        $class = 'warning';
                        $text  = APP_REF;

                        if ($entry->isCore()) {
                            $class = 'danger';
                            $text  = trans('module::admin.core');
                        }

                        if ($entry->isShared()) {
                            $class = 'info';
                            $text  = trans('module::admin.shared');
                        }

                        return '<span class="label label-' . $class . '">' . $text . '</span>';
                    }
                ]
            ]
        );
    }
}
