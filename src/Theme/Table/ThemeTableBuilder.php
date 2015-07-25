<?php namespace Anomaly\AddonsModule\Theme\Table;

use Anomaly\AddonsModule\Theme\Table\Action\DeleteTheme;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ThemeTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Theme\Table
 */
class ThemeTableBuilder extends TableBuilder
{

    /**
     * The table views.
     *
     * @var array
     */
    protected $views = [
        'all',
        'admin'  => [
            'buttons' => [
                'activate' => [
                    'button' => 'success',
                    'text'   => 'module::button.activate',
                    'href'   => 'admin/addons/themes/activate/{entry.id}'
                ]
            ]
        ],
        'public' => [
            'buttons' => [
                'activate' => [
                    'button' => 'success',
                    'text'   => 'module::button.activate',
                    'href'   => 'admin/addons/themes/activate/{entry.id}'
                ]
            ]
        ]
    ];

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        [
            'heading' => 'module::field.name.name',
            'value'   => 'entry.name'
        ],
        [
            'heading' => 'module::field.description.name',
            'value'   => 'entry.description'
        ],
        [
            'heading' => 'module::field.location.name',
            'value'   => 'entry.location_label'
        ],
        [
            'heading' => 'module::field.state.name',
            'value'   => 'entry.active_label'
        ],
        [
            'heading' => 'module::field.type.name',
            'value'   => 'entry.theme_type'
        ]
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'view'
    ];

    /**
     * The table actions.
     *
     * @var array
     */
    protected $actions = [
        'delete' => [
            'handler' => DeleteTheme::class
        ]
    ];

}
