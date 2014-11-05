<?php namespace Anomaly\Streams\Addon\Module\Addons\Ui\Table;

use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Ui\Table\Table;

/**
 * Class ExtensionTable
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Extension\Addons\Ui\Table
 */
class ExtensionTable extends Table
{

    /**
     * Set up the table.
     */
    public function boot()
    {
        $this->setPrefix('extensions');

        $this->setUpViews();
        $this->setUpColumns();
        $this->setUpButtons();
    }

    protected function setUpViews()
    {
        $this->setViews(
            [
                'installed' => ['handler' => 'InstalledExtensionsView']
            ]
        );
    }

    protected function setUpColumns()
    {
        $this->setColumns(
            [
                [
                    'heading' => 'Name',
                    'value'   => function (Extension $entry) {
                            return trans($entry->getName());
                        },
                ],
                [
                    'heading' => 'Description',
                    'value'   => function (Extension $entry) {
                            return trans($entry->getDescription());
                        },
                ],
                [
                    'heading' => null,
                    'value'   => function (Extension $entry) {
                            return '<span class="label label-success">Installed</span>';
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
                    'type'  => 'danger',
                    'title' => 'Uninstall',
                    'url'   => 'admin/extensions/install/{slug}',
                ]
            ]
        );
    }
}
 