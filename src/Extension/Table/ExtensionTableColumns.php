<?php namespace Anomaly\AddonsModule\Extension\Table;

use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Application\Application;

/**
 * Class ExtensionTableColumns
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Table\Extension
 */
class ExtensionTableColumns
{

    /**
     * Handle table columns.
     *
     * @param ExtensionTableBuilder $builder
     * @param Application           $application
     */
    public function handle(ExtensionTableBuilder $builder, Application $application)
    {
        $builder->setColumns(
            [
                [
                    'heading' => 'streams::addon.plugin',
                    'value'   => function (Extension $entry) {
                        return trans($entry->getName());
                    },
                ],
                [
                    'heading' => 'module::admin.description',
                    'value'   => function (Extension $entry) {
                        return trans($entry->getDescription());
                    },
                ],
                [
                    'heading' => 'module::admin.location',
                    'value'   => function (Extension $entry) use ($application) {

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
