<?php namespace Anomaly\Streams\Addon\Module\Addons\Ui\Table;

use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Ui\Table\Table;

/**
 * Class ModuleTable
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Module\Addons\Ui\Table
 */
class ModuleTable extends Table
{

    /**
     * Set up the table.
     */
    public function boot()
    {
        $this->setUpColumns();
    }

    protected function setUpColumns()
    {
        $this->setColumns(
            [
                [
                    'heading' => 'Name',
                    'value'   => function (Module $entry) {
                            return trans($entry->getName());
                        },
                ]
            ]
        );
    }
}
 