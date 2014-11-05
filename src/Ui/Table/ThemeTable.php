<?php namespace Anomaly\Streams\Addon\Module\Addons\Ui\Table;

use Anomaly\Streams\Platform\Addon\Theme\Theme;
use Anomaly\Streams\Platform\Ui\Table\Table;

/**
 * Class ThemeTable
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Theme\Addons\Ui\Table
 */
class ThemeTable extends Table
{

    /**
     * Set up the table.
     */
    public function boot()
    {
        $this->setPrefix('themes');

        $this->setUpViews();
        $this->setUpColumns();
        $this->setUpButtons();
    }

    protected function setUpViews()
    {
        $this->setViews(
            [
                'installed' => ['handler' => 'InstalledThemesView']
            ]
        );
    }

    protected function setUpColumns()
    {
        $this->setColumns(
            [
                [
                    'heading' => 'Name',
                    'value'   => function (Theme $entry) {
                            return trans($entry->getName());
                        },
                ],
                [
                    'heading' => 'Description',
                    'value'   => function (Theme $entry) {
                            return trans($entry->getDescription());
                        },
                ],
                [
                    'heading' => null,
                    'value'   => function (Theme $entry) {
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
                    'url'   => 'admin/themes/install/{slug}',
                ]
            ]
        );
    }
}
 