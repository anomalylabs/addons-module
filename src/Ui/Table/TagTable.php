<?php namespace Anomaly\Streams\Addon\Module\Addons\Ui\Table;

use Anomaly\Streams\Platform\Addon\Tag\Tag;
use Anomaly\Streams\Platform\Ui\Table\Table;

/**
 * Class TagTable
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Theme\Addons\Ui\Table
 */
class TagTable extends Table
{

    /**
     * Set up the table.
     */
    public function boot()
    {
        $this->setPrefix('tags');

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
                    'value'   => function (Tag $entry) {
                            return trans($entry->getName());
                        },
                ],
                [
                    'heading' => 'Description',
                    'value'   => function (Tag $entry) {
                            return trans($entry->getDescription());
                        },
                ],
                [
                    'heading' => null,
                    'value'   => function (Tag $entry) {
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
                    'url'   => 'admin/tags/install/{slug}',
                ]
            ]
        );
    }
}
 