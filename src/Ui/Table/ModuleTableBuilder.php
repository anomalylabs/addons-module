<?php namespace Anomaly\Streams\Addon\Module\Addons\Ui\Table;

use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Ui\Table\Table;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ModuleTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Module\Addons\Ui\Table
 */
class ModuleTableBuilder extends TableBuilder
{

    protected $views = ['all'];

    function __construct(Table $table)
    {
        $table->setEntries(app('streams.modules')->orderByName());

        $this->setColumns(
            [
                [
                    'header' => 'module::admin.name',
                    'value'  => function (Module $entry) {
                            return trans($entry->getName());
                        },
                ],
                [
                    'header' => 'module::admin.description',
                    'value'  => function (Module $entry) {
                            return trans($entry->getDescription());
                        },
                ],
                [
                    'value' => function (Module $entry) {

                            if ($entry->isInstalled()) {

                                $class = 'success';
                                $label = trans('module::admin.installed');
                            } else {

                                $class = 'default';
                                $label = trans('module::admin.uninstalled');
                            }

                            return '<span class="label label-' . $class . '">' . $label . '</span>';
                        },
                ],
                [
                    'value' => function (Module $entry) {

                            if ($entry->isCore()) {

                                return '<span class="label label-danger">' . trans('module::admin.core') . '</span>';
                            }
                        },
                ],
            ]
        );

        $this->setButtons(
            [
                [
                    'type'       => function (Module $entry) {

                            if ($entry->isInstalled()) {

                                return 'danger';
                            }

                            return 'success';
                        },
                    'text'       => function (Module $entry) {

                            if ($entry->isInstalled()) {

                                return trans('button.uninstall');
                            }

                            return trans('button.install');
                        },
                    'attributes' => [
                        'href' => function (Module $entry) {

                                if ($entry->isInstalled()) {

                                    return url('admin/addons/modules/uninstall/' . $entry->getSlug());
                                }

                                return url('admin/addons/modules/install/' . $entry->getSlug());
                            }
                    ],
                ]
            ]
        );

        parent::__construct($table);
    }
}
 