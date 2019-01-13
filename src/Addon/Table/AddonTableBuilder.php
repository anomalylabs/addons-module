<?php namespace Anomaly\AddonsModule\Addon\Table;

use Anomaly\AddonsModule\Addon\Table\View\UpdatesQuery;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class AddonTableBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonTableBuilder extends TableBuilder
{

    /**
     * The table views.
     *
     * @var array|string
     */
    protected $views = [
        'all',
        'downloaded',
        'updates' => [
            'query' => UpdatesQuery::class,
        ],
    ];

    /**
     * The table filters.
     *
     * @var array|string
     */
    protected $filters = [
        'search' => [
            'fields' => [
                'name',
                'title',
                'description',
            ],
        ],
    ];

}
