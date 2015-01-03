<?php namespace Anomaly\AddonsModule\Ui\Table;

use Anomaly\Streams\Platform\Addon\Block\Block;
use Anomaly\Streams\Platform\Ui\Table\Table;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class BlockTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Block\Addons\Ui\Table
 */
class BlockTableBuilder extends TableBuilder
{

    protected $views = ['all'];

    function __construct(Table $table)
    {
        $table->setEntries(app('streams.blocks')->orderByName());

        $this->setColumns(
            [
                [
                    'header' => 'module::admin.name',
                    'value'  => function (Block $entry) {
                            return trans($entry->getName());
                        },
                ],
                [
                    'header' => 'module::admin.description',
                    'value'  => function (Block $entry) {
                            return trans($entry->getDescription());
                        },
                ],
                [
                    'value' => function (Block $entry) {

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
