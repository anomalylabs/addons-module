<?php namespace Streams\Addon\Module\Addons\Controller\Admin;

use Streams\Addon\Module\Addons\Component\TestColumn;
use Streams\Addon\Module\Addons\Component\TestSection;
use Streams\Core\Http\Controller\AdminController;
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
            ->setViews(
                [
                    [
                        'title' => 'All',
                    ],
                    [
                        'title' => 'Uninstalled',
                    ]
                ]
            )
            ->setColumns(
                [
                    'id',
                    'name',
                    'slug',
                    'description',
                ]
            )
            ->setButtons(
                [
                    [
                        'title'      => 'button.edit',
                        'url'        => function ($ui, $entry) {
                                return 'admin/addons/modules/edit/' . $entry->getKey();
                            },
                        'attributes' => [
                            'class' => 'btn btn-sm btn-warning',
                        ]
                    ]
                ]
            )
            ->setActions(
                [
                    [
                        'title'      => 'button.delete',
                        'attributes' => [
                            'class' => 'btn btn-sm btn-danger',
                        ]
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
    public function create()
    {
        return $this->form
            ->setSkips(
                [
                    'slug'
                ]
            )
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