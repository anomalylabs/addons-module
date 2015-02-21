<?php namespace Anomaly\AddonsModule\Distribution\Table;

use Anomaly\Streams\Platform\Addon\Distribution\Distribution;
use Anomaly\Streams\Platform\Application\Application;

/**
 * Class DistributionTableColumns
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Distribution\Table
 */
class DistributionTableColumns
{

    /**
     * Handle the table columns.
     *
     * @param DistributionTableBuilder $builder
     * @param Application              $application
     */
    public function handle(DistributionTableBuilder $builder, Application $application)
    {
        $builder->setColumns(
            [
                [
                    'heading' => 'streams::addon.distribution',
                    'value'   => function (Distribution $entry) {
                        return trans($entry->getName());
                    },
                ],
                [
                    'heading' => 'module::admin.description',
                    'value'   => function (Distribution $entry) {
                        return trans($entry->getDescription());
                    },
                ],
                [
                    'heading' => 'module::admin.location',
                    'value'   => function (Distribution $entry) use ($application) {

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
                ],
                [
                    'heading' => 'module::admin.active',
                    'value'   => function (Distribution $entry) {

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
