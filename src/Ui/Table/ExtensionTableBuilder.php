<?php namespace Anomaly\Streams\Addon\Module\Addons\Ui\Table;

use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Ui\Table\Table;
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

    protected $views = ['all'];

    function __construct(Table $table)
    {
        $table->setEntries(app('streams.extensions')->orderByName());

        $this->setColumns(
            [
                [
                    'header' => 'module::admin.name',
                    'value'  => function (Extension $entry) {
                            return trans($entry->getName());
                        },
                ],
                [
                    'header' => 'module::admin.description',
                    'value'  => function (Extension $entry) {
                            return trans($entry->getDescription());
                        },
                ],
                [
                    'value' => function (Extension $entry) {

                            if ($entry->isCore()) {

                                return '<span class="label label-danger">' . trans('module::admin.core') . '</span>';
                            }
                        },
                ],
            ]
        );

        parent::__construct($table);
    }
}
 