<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleAddonsCreateAddonsFields
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleAddonsCreateAddonsFields extends Migration
{

    /**
     * The fields definition.
     *
     * @var array
     */
    protected $fields = [
        'type'        => 'anomaly.field_type.text',
        'name'        => 'anomaly.field_type.text',
        'slug'        => [
            'type'   => 'anomaly.field_type.slug',
            'config' => [
                'slugify' => 'name',
            ],
        ],
        'repository'  => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\AddonsModule\Repository\RepositoryModel',
            ],
        ],
        'namespace'   => 'anomaly.field_type.text',
        'title'       => 'anomaly.field_type.text',
        'description' => 'anomaly.field_type.textarea',
        'marketplace' => 'anomaly.field_type.textarea',
        'homepage'    => 'anomaly.field_type.url',
        'requires'    => 'anomaly.field_type.textarea',
        'suggests'    => 'anomaly.field_type.textarea',
        'versions'    => 'anomaly.field_type.textarea',
        'licenses'    => 'anomaly.field_type.textarea',
        'authors'     => 'anomaly.field_type.textarea',
        'support'     => 'anomaly.field_type.textarea',
        'assets'      => 'anomaly.field_type.textarea',
        'readme'      => 'anomaly.field_type.textarea',
        'url'         => 'anomaly.field_type.url',
    ];

}
