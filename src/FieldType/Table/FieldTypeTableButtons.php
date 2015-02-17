<?php namespace Anomaly\AddonsModule\FieldType\Table;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class FieldTypeTableButtons
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\FieldType\Table
 */
class FieldTypeTableButtons
{

    /**
     * Return the table buttons.
     */
    public function handle(FieldTypeTableBuilder $builder)
    {
        $builder->setButtons(
            [
                [
                    'icon'       => 'question-circle',
                    'href'       => function (FieldType $entry) {
                        return '/admin/addons/field_types/readme/' . $entry->getNamespace();
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
