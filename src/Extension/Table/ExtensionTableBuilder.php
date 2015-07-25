<?php namespace Anomaly\AddonsModule\Extension\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ExtensionTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Extension\Table
 */
class ExtensionTableBuilder extends TableBuilder
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
