<?php namespace Anomaly\Streams\Addon\Module\Addons\Controller\Admin;

use Streams\Addon\Module\Addons\Component\TestColumn;
use Streams\Addon\Module\Addons\Component\TestSection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Stream\Utility\StreamSchemaUtility;
use Anomaly\Streams\Platform\Ui\FormUi;
use Anomaly\Streams\Platform\Ui\TableUi;

abstract class AddonsControllerAbstract extends AdminController
{
    /**
     * Create a new ThemesController instance.
     */
    public function __construct()
    {
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
            ->setOrderBy('slug', 'ASC')
            ->setViews(
                [
                    [
                        'title' => 'All',
                    ],
                    [
                        'title' => 'Installed',
                        'query' => function ($query) {
                                return $query->whereIsInstalled(true);
                            }
                    ],
                    [
                        'title' => 'Uninstalled',
                        'query' => function ($query) {
                                return $query->whereIsInstalled(false);
                            }
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
                    [
                        'title' => 'misc.untitled',
                        'value' => 'ID: {id}'
                    ],
                    'slug',
                    'description',
                ]
            )
            ->setButtons(
                [
                    [
                        'type'    => 'success',
                        'title'   => 'Install',
                        'path'    => function ($ui, $entry) {
                                return 'admin/addons/installer/install/' . str_singular(
                                    \Request::segment(
                                        3
                                    )
                                ) . '/' . $entry->slug.'?_debug';
                            },
                        'display' => function ($ui, $entry) {
                                return !boolean($entry->is_installed);
                            },
                    ],
                    [
                        'type'    => 'danger',
                        'title'   => 'Uninstall',
                        'path'    => function ($ui, $entry) {
                                return 'admin/addons/installer/uninstall/' . str_singular(
                                    \Request::segment(
                                        3
                                    )
                                ) . '/' . $entry->slug;
                            },
                        'display' => function ($ui, $entry) {
                                return boolean($entry->is_installed);
                            },
                    ]
                ]
            )
            ->setActions(
                [
                    [
                        'type'   => 'delete',
                        'action' => 'admin/addons/modules/delete',
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
                        'type'     => 'save',
                        'redirect' => function ($entry) {
                                return 'admin/addons/' . \Request::segment(3);
                            },
                    ],
                    [
                        'type'     => 'save_exit',
                        'redirect' => 'admin/addons/modules',
                    ],
                    [
                        'type'     => 'save_continue',
                        'redirect' => function ($entry) {
                                return 'admin/addons/' . \Request::segment(3);
                            },
                    ],
                    [
                        'type' => 'cancel',
                        'path' => 'admin/addons/modules',
                    ],
                    [
                        'type' => 'delete',
                        'path' => function ($ui) {
                                return 'admin/addons/' . \Request::segment(3) . '/delete/' . $ui->getEntry()->getKey();
                            },
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
                        'type'     => 'save',
                        'redirect' => function ($entry) {
                                return 'admin/addons/' . \Request::segment(3);
                            },
                    ],
                    [
                        'type'     => 'save_exit',
                        'redirect' => 'admin/addons/modules',
                    ],
                    [
                        'type'     => 'save_continue',
                        'redirect' => function ($entry) {
                                return 'admin/addons/' . \Request::segment(3);
                            },
                    ],
                    [
                        'type' => 'cancel',
                        'path' => 'admin/addons/modules',
                    ],
                    [
                        'type' => 'delete',
                        'path' => function ($ui) {
                                return 'admin/addons/' . \Request::segment(3) . '/delete/' . $ui->getEntry()->getKey();
                            },
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
    public function delete($id = null)
    {
        $messages = app()->make('streams.messages');

        $messages->add('success', 'Boom bitch: ' . count(\Input::get('id')))->flash();

        return redirect(referer('admin/addons/' . \Request::segment(3)));
    }
}