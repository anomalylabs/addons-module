<?php namespace Anomaly\Streams\Addon\Module\Addons\Ui\Table;

use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Ui\Table\Table;

/**
 * Class ModuleTable
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Module\Addons\Ui\Table
 */
class ModuleTable extends Table
{

    /**
     * Set up the table.
     */
    public function boot()
    {
        $this->setPrefix('modules');

        $this->setUpViews();
        $this->setUpColumns();
        $this->setUpButtons();
    }

    protected function setUpViews()
    {
        $this->setViews(
            [
                'installed' => ['handler' => 'InstalledModulesView']
            ]
        );
    }

    protected function setUpColumns()
    {
        $this->setColumns(
            [
                [
                    'heading' => 'Name',
                    'value'   => function (Module $entry) {
                            return trans($entry->getName());
                        },
                ],
                [
                    'heading' => null,
                    'value'   => function (Module $entry) {
                            return '<span class="label label-success">Installed</span>';
                        },
                ],
                [
                    'heading' => 'Description',
                    'value'   => function (Module $entry) {
                            return trans($entry->getDescription());
                        },
                ],
            ]
        );
    }

    protected function setUpButtons()
    {
        $this->setButtons(
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
        );
    }
}
 