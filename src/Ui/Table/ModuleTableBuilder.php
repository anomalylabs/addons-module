<?php namespace Anomaly\Streams\Addon\Module\Addons\Ui\Table;

use Anomaly\Streams\Addon\Module\Addons\Ui\Table\View\InstalledModulesView;
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

    function __construct(Table $table)
    {
        $table->setEntries(app('streams.modules'));

        $this->setUpViews();
        $this->setUpColumns();
        $this->setUpButtons();

        parent::__construct($table);
    }

    protected function setUpViews()
    {
        $this->setViews(
            [
                'installed' => new InstalledModulesView()
            ]
        );
    }

    protected function setUpColumns()
    {
        $this->setColumns(
            [
                [
                    'header' => 'Name',
                    'value'  => function (Module $entry) {
                            return trans($entry->getName());
                        },
                ],
                [
                    'header' => 'Description',
                    'value'  => function (Module $entry) {
                            return trans($entry->getDescription());
                        },
                ],
                [
                    'header' => null,
                    'value'  => function (Module $entry) {
                            return '<span class="label label-success">Installed</span>';
                        },
                ],
            ]
        );
    }

    protected function setUpButtons()
    {
        /*$this->setButtons(
            [
                [
                    'type'    => 'success',
                    'title'   => 'Install',
                    'enabled' => function (Module $entry) {

                            return !$entry->isInstalled();
                        },
                    'url'     => 'admin/addons/modules/install/{slug}',
                ],
                [
                    'type'    => 'danger',
                    'title'   => 'Uninstall',
                    'enabled' => function (Module $entry) {

                            return $entry->isInstalled();
                        },
                    'url'     => 'admin/addons/modules/uninstall/{slug}',
                ]
            ]
        );*/
    }
}
 