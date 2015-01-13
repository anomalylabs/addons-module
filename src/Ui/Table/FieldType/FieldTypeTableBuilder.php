<?php namespace Anomaly\AddonsModule\Ui\Table\FieldType;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class FieldTypeTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\FieldType\Addons\Ui\Table
 */
class FieldTypeTableBuilder extends TableBuilder
{

    /**
     * The table entries.
     *
     * @var string
     */
    protected $entries = 'Anomaly\AddonsModule\Ui\Table\FieldType\Handler\EntriesHandler@handle';

    /**
     * The columns configuration.
     *
     * @var string
     */
    protected $columns = 'Anomaly\AddonsModule\Ui\Table\FieldType\Handler\ColumnHandler@handle';

    /**
     * The buttons configuration.
     *
     * @var string
     */
    protected $buttons = 'Anomaly\AddonsModule\Ui\Table\FieldType\Handler\ButtonHandler@handle';

}
