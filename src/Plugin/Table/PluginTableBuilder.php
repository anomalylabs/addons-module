<?php namespace Anomaly\AddonsModule\Plugin\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class PluginTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Plugin\Table
 */
class PluginTableBuilder extends TableBuilder
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
