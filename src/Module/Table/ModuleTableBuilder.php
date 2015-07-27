<?php namespace Anomaly\AddonsModule\Module\Table;

use Anomaly\AddonsModule\Module\Table\Action\DeleteModule;
use Anomaly\AddonsModule\Module\Table\Action\DisableModule;
use Anomaly\AddonsModule\Module\Table\Action\InstallModule;
use Anomaly\AddonsModule\Module\Table\Action\UninstallModule;
use Anomaly\Streams\Platform\Addon\Module\Command\EnableModule;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ModuleTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Module\Table
 */
class ModuleTableBuilder extends TableBuilder
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
                'delete' => [
                    'handler' => DeleteModule::class
                ],
                'enable' => [
                    'button'  => 'success',
                    'text'    => 'module::button.enable',
                    'handler' => EnableModule::class
                ]
            ]
        ],
        'uninstalled' => [
            'actions' => [
                'delete' => [
                    'handler' => DeleteModule::class
                ],
                'enable' => [
                    'button'  => 'success',
                    'text'    => 'module::button.install',
                    'handler' => InstallModule::class
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
        'view' => [
            'href' => 'admin/addons/modules/view/{entry.id}'
        ]
    ];

    /**
     * The table actions.
     *
     * @var array
     */
    protected $actions = [
        'delete'    => [
            'handler' => DeleteModule::class
        ],
        'disable'   => [
            'button'       => 'confirm',
            'text'         => 'module::button.disable',
            'icon'         => 'fa fa-exclamation-circle',
            'data-message' => 'module::confirm.disable',
            'handler'      => DisableModule::class
        ],
        'uninstall' => [
            'button'       => 'confirm',
            'text'         => 'module::button.uninstall',
            'icon'         => 'fa fa-exclamation-circle',
            'data-message' => 'module::confirm.uninstall',
            'handler'      => UninstallModule::class
        ]
    ];
}
