<?php namespace Streams\Addon\Module\Addons\Controller\Admin;

use Addon\Module\Addons\Component\TestColumn;
use Addon\Module\Addons\Component\TestSection;
use Streams\Core\Controller\AdminController;
use Streams\Core\Ui\FormUi;
use Streams\Core\Ui\TableUi;

abstract class AddonsControllerAbstract extends AdminController
{
    /**
     * Create a new ThemesController instance.
     */
    public function __construct()
    {
        parent::__construct();

        $this->table = new TableUi($this->addons);
        $this->form  = new FormUi($this->addons);

        $this->addons->sync();
    }

    /**
     * Display a table of all modules.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return $this->table
            ->setLimit('all')
            ->setColumns(
                [
                    [
                        'header' => function ($headerObject) {
                                return 'Instanceof';
                            },
                        'column' => new TestColumn(),
                    ],
                    [
                        'header' => 'misc.closure', // Translatable
                        'column' => function ($columnObject) {
                                return 'This is the ' . $columnObject->getEntry()->name;
                            }
                    ],
                    'id', // System field
                    'slug', // Slug field type
                    'name', // Presenter method
                    'description', // Presenter method
                ]
            )
            ->setButtons(
                function ($row) {

                    $entry = $row->getEntry();

                    $edit = [
                        'title'      => 'button.edit',
                        'attributes' => [
                            'class' => '+ btn-warning',
                            'href'  => function () use ($entry) {
                                    return url('admin/addons/modules/edit/' . $entry->getKey());
                                },
                        ]
                    ];

                    $install = [
                        'title'      => 'module.addons::button.install',
                        'attributes' => [
                            'class' => '+ btn-success',
                            'href'  => function () use ($entry) {
                                    return url('admin/addons/installer/install/module/' . $entry->slug);
                                },
                        ]
                    ];

                    $uninstall = [
                        'title'      => 'module.addons::button.uninstall',
                        'attributes' => [
                            'class' => '+ btn-danger',
                            'href'  => function () use ($entry) {
                                    return url('admin/addons/installer/uninstall/module/' . $entry->slug);
                                },
                        ]
                    ];

                    return $entry->is_installed ? [$edit, $uninstall] : [$install];
                }
            )->render();
    }

    /**
     * Display a table of all modules.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return $this->form
            ->setSkips(
                [
                    'slug'
                ]
            )
            /*->addSection(
                new TestSection()
            )*/
            ->addSection(
                [
                    'title'  => 'Dude.. this is awesome.',
                    'fields' => [
                        'slug',
                        'is_enabled',
                        'is_installed',
                    ]
                ]
            )
            ->setActions(
                [
                    [
                        'value' => 'foo',
                        'class' => 'btn btn-info',
                        'text'  => 'Save',
                    ],
                    [
                        'value' => 'bar',
                        'class' => 'btn btn-success',
                        'text'  => 'Save & Exit',
                    ],
                    [
                        'value' => 'cancel',
                        'class' => 'btn btn-default',
                        'text'  => 'Cancel',
                    ]
                ]
            )
            ->render();
    }

    /**
     * Display a table of all modules.
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        return $this->form
            ->setEntry($this->addons->find($id))
            ->setSections(
                [
                    [
                        'title' => 'misc.untitled',
                        'tabs'  => [
                            [
                                'title'  => 'Ef',
                                'fields' => [
                                    'slug',
                                ],
                            ],
                            [
                                'title'  => 'Boom',
                                'fields' => [
                                    'is_enabled',
                                ],
                            ],
                            [
                                'title'  => 'Face',
                                'fields' => [
                                    'is_installed',
                                ],
                            ]
                        ]
                    ]
                ]
            )
            ->setActions(
                [
                    [
                        'value' => 'foo',
                        'class' => 'btn btn-info',
                        'text'  => 'Save',
                    ],
                    [
                        'value' => 'bar',
                        'class' => 'btn btn-success',
                        'text'  => 'Save & Exit',
                    ],
                    [
                        'value' => 'cancel',
                        'class' => 'btn btn-default',
                        'text'  => 'Cancel',
                    ]
                ]
            )
            ->render();
    }
}