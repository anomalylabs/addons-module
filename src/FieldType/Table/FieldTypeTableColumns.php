<?php namespace Anomaly\AddonsModule\FieldType\Table;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Application\Application;

/**
 * Class FieldTypeTableColumns
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\FieldType\Table
 */
class FieldTypeTableColumns
{

    /**
     * Handle table columns.
     *
     * @param FieldTypeTableBuilder $builder
     * @param Application           $application
     */
    public function handle(FieldTypeTableBuilder $builder, Application $application)
    {
        $builder->setColumns(
            [
                [
                    'heading' => 'streams::addon.plugin',
                    'value'   => function (FieldType $entry) {
                        return trans($entry->getName());
                    },
                ],
                [
                    'heading' => 'module::admin.description',
                    'value'   => function (FieldType $entry) {
                        return trans($entry->getDescription());
                    },
                ],
                [
                    'heading' => 'module::admin.location',
                    'value'   => function (FieldType $entry) use ($application) {

                        $class = 'warning';
                        $text  = $application->getReference();

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
