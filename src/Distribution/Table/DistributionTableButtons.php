<?php namespace Anomaly\AddonsModule\Distribution\Table;

use Anomaly\Streams\Platform\Addon\Distribution\Distribution;

/**
 * Class DistributionTableButtons
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Distribution\Table
 */
class DistributionTableButtons
{

    /**
     * Return the table buttons.
     */
    public function handle(DistributionTableBuilder $builder)
    {
        $builder->setButtons(
            [
                [
                    'icon'       => 'question-circle',
                    'href'       => function (Distribution $entry) {
                        return '/admin/addons/distributions/readme/' . $entry->getNamespace();
                    },
                    'attributes' => [
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-lg'
                    ]
                ]
            ]
        );
    }
}
