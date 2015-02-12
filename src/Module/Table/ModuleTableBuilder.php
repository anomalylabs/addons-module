<?php namespace Anomaly\AddonsModule\Module\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ModuleTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Table
 */
class ModuleTableBuilder extends TableBuilder
{

    /**
     * The views configuration.
     *
     * @var string
     */
    protected $views = 'Anomaly\AddonsModule\Module\Table\ModuleTableViews@handle';

    /**
     * The columns configuration.
     *
     * @var string
     */
    protected $columns = 'Anomaly\AddonsModule\Module\Table\ModuleTableColumns@handle';

    /**
     * The buttons configuration.
     *
     * @var string
     */
    protected $buttons = 'Anomaly\AddonsModule\Module\Table\ModuleTableButtons@handle';

}
