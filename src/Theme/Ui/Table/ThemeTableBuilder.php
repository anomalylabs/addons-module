<?php namespace Anomaly\AddonsModule\Theme\Ui\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ThemeTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Theme\Addons\Ui\Table
 */
class ThemeTableBuilder extends TableBuilder
{

    /**
     * The table entries.
     *
     * @var string
     */
    protected $entries = 'Anomaly\AddonsModule\Theme\Ui\Table\Handler\EntriesHandler@handle';

    /**
     * The views configuration.
     *
     * @var string
     */
    protected $views = 'Anomaly\AddonsModule\Theme\Ui\Table\Handler\ViewHandler@handle';

    /**
     * The columns configuration.
     *
     * @var string
     */
    protected $columns = 'Anomaly\AddonsModule\Theme\Ui\Table\Handler\ColumnHandler@handle';

    /**
     * The buttons configuration.
     *
     * @var string
     */
    protected $buttons = 'Anomaly\AddonsModule\Theme\Ui\Table\Handler\ButtonHandler@handle';

}
