<?php namespace Anomaly\Streams\Module\Addons\Controller\Admin;

use Anomaly\Streams\Module\Addons\Component\TestColumn;
use Anomaly\Streams\Module\Addons\Component\TestSection;
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
            ->setLimit(5)
            ->setViews(
                [
                    [
                        'title' => 'All',
                    ],
                    [
                        'title'     => 'Uninstalled',
                        'callbacks' => [
                            'query' => function ($query) {
                                    return $query->whereIsInstalled(false);
                                }
                        ]
                    ]
                ]
            )
            ->setFilters(
                [
                    [
                        'type'        => 'text',
                        'name'        => 'slug',
                        'placeholder' => 'Slug',
                        'query'       => function ($query, $filter) {
                                return $query->where('slug', 'LIKE', "%{$filter->getValue()}%");
                            },
                    ],
                ]
            )
            ->setColumns(
                [
                    'ID: {id}',
                    [
                        'title' => 'misc.untitled',
                        'value' => 'name'
                    ],
                    'slug',
                    'description',
                ]
            )
            ->setButtons(
                [
                    [
                        'title'      => 'button.edit',
                        'path'       => function ($ui, $entry) {
                                return 'admin/addons/' . \Request::segment(3) . '/edit/' . $entry->getKey();
                            },
                        'attributes' => [
                            'class' => 'btn btn-sm btn-warning',
                        ],
                        'dropdown'   => [
                            [
                                'title' => 'button.delete',
                                'path'  => function ($ui, $entry) {
                                        return 'admin/addons/' . \Request::segment(3) . '/delete/' . $entry->getKey();
                                    },
                            ]
                        ]
                    ]
                ]
            )
            ->setActions(
                [
                    [
                        'title'    => 'button.delete',
                        'class'    => 'btn btn-sm btn-danger',
                        'dropdown' => [
                            [
                                'title' => 'Move',
                                'path'  => function ($ui, $entry) {
                                        return 'admin/addons/' . \Request::segment(3) . '/move/' . $entry->getKey();
                                    },
                            ]
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
            ->setSections(
                [
                    [
                        'title'  => 'misc.untitled',
                        'fields' => [
                            'slug',
                            'is_enabled',
                            'is_installed',
                        ]
                    ],
                ]
            )
            ->setActions(
                [
                    [
                        'title'      => 'button.save',
                        'redirect'   => function ($ui) {
                                return 'admin/addons/' . \Request::segment(3) . '/edit/' . $ui->getEntry()->getKey();
                            },
                        'attributes' => [
                            'value' => 'save',
                            'name'  => 'formAction',
                            'class' => 'btn btn-sm btn-success',
                        ],
                    ],
                    [
                        'title'      => 'button.save_exit',
                        'redirect'   => 'admin/addons/modules',
                        'attributes' => [
                            'value' => 'save_exit',
                            'name'  => 'formAction',
                            'class' => 'btn btn-sm btn-info',
                        ],
                    ],
                    [
                        'title'      => 'button.cancel',
                        'attributes' => [
                            'value' => 'cancel',
                            'path'  => 'admin/addons/modules',
                            'class' => 'btn btn-sm btn-default',
                        ],
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
                        'fields' => [
                            'slug',
                            'is_enabled',
                            'is_installed',
                        ]
                    ],
                ]
            )
            ->setActions(
                [
                    [
                        'title'      => 'button.save',
                        'redirect'   => function ($entry) {
                                return 'admin/addons/' . \Request::segment(3);
                            },
                        'attributes' => [
                            'value' => 'save',
                            'name'  => 'formAction',
                            'class' => 'btn btn-sm btn-success',
                        ],
                    ],
                    [
                        'title'      => 'button.save_exit',
                        'redirect'   => 'admin/addons/modules',
                        'attributes' => [
                            'value' => 'save_exit',
                            'name'  => 'formAction',
                            'class' => 'btn btn-sm btn-info',
                        ],
                    ],
                    [
                        'title'      => 'button.cancel',
                        'attributes' => [
                            'value' => 'cancel',
                            'path'  => 'admin/addons/modules',
                            'class' => 'btn btn-sm btn-default',
                        ],
                    ],
                    [
                        'title'      => 'button.delete',
                        'attributes' => [
                            'value' => 'delete',
                            'path'  => function ($ui) {
                                    return 'admin/addons/' . \Request::segment(3) . '/delete/' . $ui->getEntry(
                                    )->getKey();
                                },
                            'class' => 'btn btn-sm btn-danger pull-right',
                        ],
                    ]
                ]
            )
            ->render();
    }

    /**
     * Delete an addon.
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $this->addons->find($id)->delete($id);

        return \Redirect::to('admin/addons/modules');
    }
}