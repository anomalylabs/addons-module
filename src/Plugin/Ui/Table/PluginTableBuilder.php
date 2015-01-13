<?php namespace Anomaly\AddonsModule\Ui\Table\Plugin;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class PluginTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Plugin\Addons\Ui\Table
 */
class PluginTableBuilder extends TableBuilder
{

    /**
     * The table entries.
     *
     * @var string
     */
    protected $entries = 'Anomaly\AddonsModule\Plugin\Ui\Table\Handler\EntriesHandler@handle';

    /**
     * The columns configuration.
     *
     * @var string
     */
    protected $columns = 'Anomaly\AddonsModule\Plugin\Ui\Table\Handler\ColumnHandler@handle';

    /**
     * The buttons configuration.
     *
     * @var string
     */
    protected $buttons = 'Anomaly\AddonsModule\Plugin\Ui\Table\Handler\ButtonHandler@handle';

}
