<?php namespace Anomaly\AddonsModule\Ui\Table;

use Anomaly\Streams\Platform\Addon\Tag\Tag;
use Anomaly\Streams\Platform\Ui\Table\Table;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class TagTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Tag\Addons\Ui\Table
 */
class TagTableBuilder extends TableBuilder
{

    protected $views = ['all'];

    function __construct(Table $table)
    {
        $table->setEntries(app('streams.tags')->orderByName());

        $this->setColumns(
            [
                [
                    'header' => 'module::admin.name',
                    'value'  => function (Tag $entry) {
                            return trans($entry->getName());
                        },
                ],
                [
                    'header' => 'module::admin.description',
                    'value'  => function (Tag $entry) {
                            return trans($entry->getDescription());
                        },
                ],
                [
                    'value' => function (Tag $entry) {

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
 