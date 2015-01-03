<?php namespace Anomaly\AddonsModule\Ui\Table\Module;

use Anomaly\Streams\Platform\Ui\Table\Table;
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
     * The views configuration.
     *
     * @var array
     */
    protected $views = ['all'];

    /**
     * The columns configuration.
     *
     * @var string
     */
    protected $columns = 'Anomaly\AddonsModule\Ui\Table\Module\ModuleTableColumns@handle';

    /**
     * The buttons configuration.
     *
     * @var string
     */
    protected $buttons = 'Anomaly\AddonsModule\Ui\Table\Module\ModuleTableButtons@handle';

    /**
     * Create a new ModuleTableBuilder instance.
     *
     * @param Table $table
     */
    public function __construct(Table $table)
    {
        $table->setEntries(app('streams.modules')->orderByName());

        parent::__construct($table);
    }
}
