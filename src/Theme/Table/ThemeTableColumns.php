<?php namespace Anomaly\AddonsModule\Theme\Table;

use Anomaly\Streams\Platform\Addon\Theme\Theme;

/**
 * Class ThemeTableColumns
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Theme\Table
 */
class ThemeTableColumns
{

    /**
     * Handle the table columns.
     *
     * @param ThemeTableBuilder $builder
     */
    public function handle(ThemeTableBuilder $builder)
    {
        $builder->setColumns(
            [
                [
                    'heading' => 'streams::addon.theme',
                    'value'   => function (Theme $entry) {
                        return trans($entry->getName());
                    },
                ],
                [
                    'heading' => 'module::admin.description',
                    'value'   => function (Theme $entry) {
                        return trans($entry->getDescription());
                    },
                ],
                [
                    'heading' => 'module::admin.type',
                    'value'   => function (Theme $entry) {

                        if ($entry->isAdmin()) {
                            $class = 'danger';
                            $text  = trans('module::admin.admin');
                        } else {
                            $class = 'info';
                            $text  = trans('module::admin.standard');
                        }

                        return '<span class="label label-' . $class . '">' . $text . '</span>';
                    }
                ],
                [
                    'heading' => 'module::admin.location',
                    'value'   => function (Theme $entry) {

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
                ],
                [
                    'heading' => 'module::admin.active',
                    'value'   => function (Theme $entry) {

                        if ($entry->isActive()) {
                            $class = 'success';
                            $text  = trans('module::admin.active');

                            return '<span class="label label-' . $class . '">' . $text . '</span>';
                        }
                    }
                ]
            ]
        );
    }
}
