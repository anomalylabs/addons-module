<?php namespace Anomaly\AddonsModule\Extension\Ui\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ExtensionTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Extension\Addons\Ui\Table
 */
class ExtensionTableBuilder extends TableBuilder
{

    /**
     * The table entries.
     *
     * @var string
     */
    protected $entries = 'Anomaly\AddonsModule\Extension\Ui\Table\Handler\EntriesHandler@handle';

    /**
     * The columns configuration.
     *
     * @var string
     */
    protected $columns = 'Anomaly\AddonsModule\Extension\Ui\Table\Handler\ColumnHandler@handle';

    /**
     * The buttons configuration.
     *
     * @var string
     */
    protected $buttons = 'Anomaly\AddonsModule\Extension\Ui\Table\Handler\ButtonHandler@handle';

}
