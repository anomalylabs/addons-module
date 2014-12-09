<?php namespace Anomaly\Streams\Addon\Module\Addons\Ui\Table;

use Anomaly\Streams\Platform\Addon\Theme\Theme;
use Anomaly\Streams\Platform\Ui\Table\Table;
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

    protected $views = ['all'];

    function __construct(Table $table)
    {
        $table->setEntries(app('streams.themes')->orderByName());

        $this->setColumns(
            [
                [
                    'header' => 'module::admin.name',
                    'value'  => function (Theme $entry) {
                            return trans($entry->getName());
                        },
                ],
                [
                    'header' => 'module::admin.description',
                    'value'  => function (Theme $entry) {
                            return trans($entry->getDescription());
                        },
                ],
                [
                    'value' => function (Theme $entry) {

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
 