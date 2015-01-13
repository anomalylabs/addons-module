<?php namespace Anomaly\AddonsModule\Module\Ui\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ModuleTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Ui\Table
 */
class ModuleTableBuilder extends TableBuilder
{

    /**
     * The table entries.
     *
     * @var string
     */
    protected $entries = 'Anomaly\AddonsModule\Module\Ui\Table\Handler\EntriesHandler@handle';

    /**
     * The views configuration.
     *
     * @var string
     */
    protected $views = 'Anomaly\AddonsModule\Module\Ui\Table\Handler\ViewHandler@handle';

    /**
     * The columns configuration.
     *
     * @var string
     */
    protected $columns = 'Anomaly\AddonsModule\Module\Ui\Table\Handler\ColumnHandler@handle';

    /**
     * The buttons configuration.
     *
     * @var string
     */
    protected $buttons = 'Anomaly\AddonsModule\Module\Ui\Table\Handler\ButtonHandler@handle';

}
