<?php namespace Anomaly\AddonsModule\Addon\Table;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class AddonTableColumns
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Addon\Table
 */
class AddonTableColumns
{

    /**
     * Handle the table columns.
     *
     * @param AddonTableBuilder $builder
     */
    public function handle(AddonTableBuilder $builder)
    {
        $type = $builder->getOption('addon_type');

        $columns = [
            [
                'heading' => 'streams::addon.' . str_singular($type),
                'value'   => function (Addon $entry) {
                    return app('html')->link(
                        implode(
                            '/',
                            array_filter(
                                [
                                    'admin',
                                    'addons',
                                    str_plural($entry->getType()),
                                    $entry->getNamespace()
                                ]
                            )
                        ),
                        trans($entry->getName())
                    );
                },
            ],
            [
                'heading' => 'module::admin.description',
                'value'   => function (Addon $entry) {
                    return trans($entry->getDescription());
                }
            ],
            [
                'heading' => 'module::admin.location',
                'value'   => function (Addon $entry) {

                    $class = 'warning';
                    $text  = trans('module::admin.private');

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
        ];

        if (in_array($type, ['modules', 'extensions'])) {
            $columns[] = [
                'heading' => 'module::admin.installed',
                'value'   => function ($entry) {

                    /* @var Module|Extension $entry */
                    if ($entry->isInstalled()) {
                        $class = 'success';
                        $text  = trans('module::admin.installed');
                    } else {
                        $class = 'default';
                        $text  = trans('module::admin.not_installed');
                    }

                    return '<span class="label label-' . $class . '">' . $text . '</span>';
                }
            ];
        }

        $builder->setColumns($columns);
    }
}
