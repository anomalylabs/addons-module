<?php namespace Anomaly\AddonsModule\Extension\Table;

use Anomaly\AddonsModule\Extension\Table\Action\DeleteExtension;
use Anomaly\AddonsModule\Extension\Table\Action\DisableExtension;
use Anomaly\AddonsModule\Extension\Table\Action\InstallExtension;
use Anomaly\AddonsModule\Extension\Table\Action\UninstallExtension;
use Anomaly\Streams\Platform\Addon\Extension\Command\EnableExtension;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ExtensionTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Extension\Table
 */
class ExtensionTableBuilder extends TableBuilder
{

    /**
     * The table views.
     *
     * @var array
     */
    protected $views = [
        'all',
        'disabled'    => [
            'actions' => [
                'delete'    => [
                    'handler' => DeleteExtension::class
                ],
                'enable' => [
                    'button'  => 'success',
                    'text'    => 'module::button.enable',
                    'handler' => EnableExtension::class
                ]
            ]
        ],
        'uninstalled' => [
            'actions' => [
                'delete'    => [
                    'handler' => DeleteExtension::class
                ],
                'enable' => [
                    'button'  => 'success',
                    'text'    => 'module::button.install',
                    'handler' => InstallExtension::class
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
            'value'   => 'entry.state_label'
        ],
        [
            'heading' => 'module::field.status.name',
            'value'   => 'entry.status_label'
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
        'delete'    => [
            'handler' => DeleteExtension::class
        ],
        'disable'   => [
            'button'       => 'confirm',
            'text'         => 'module::button.disable',
            'icon'         => 'fa fa-exclamation-circle',
            'data-message' => 'module::confirm.disable',
            'handler'      => DisableExtension::class
        ],
        'uninstall' => [
            'button'       => 'confirm',
            'text'         => 'module::button.uninstall',
            'icon'         => 'fa fa-exclamation-circle',
            'data-message' => 'module::confirm.uninstall',
            'handler'      => UninstallExtension::class
        ]
    ];
}
