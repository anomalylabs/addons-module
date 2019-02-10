<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleAddonsCreateAddonsStream
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleAddonsCreateAddonsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'addons',
        'title_column' => 'name',
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'type'      => [
            'required' => true,
        ],
        'name'      => [
            'required' => true,
            'unique'   => true,
        ],
        'namespace' => [
            'required' => true,
            'unique'   => true,
        ],
        'title'     => [
            'required' => true,
        ],
        'versions'  => [
            'required' => true,
        ],
        'marketplace',
        'description',
        'homepage',
        'requires',
        'suggests',
        'licenses',
        'authors',
        'support',
        'assets',
        'readme',
    ];

}
