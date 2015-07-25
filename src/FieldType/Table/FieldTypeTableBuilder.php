<?php namespace Anomaly\AddonsModule\FieldType\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class FieldTypeTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\FieldType\Table
 */
class FieldTypeTableBuilder extends TableBuilder
{

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        [
            'heading' => 'module::field.name.name',
            'value'   => 'entry.name'
        ]
    ];

}
