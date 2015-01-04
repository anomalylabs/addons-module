<?php namespace Anomaly\AddonsModule\Ui\Table\Plugin\Handler;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;

/**
 * Class ColumnHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Ui\Table\Plugin
 */
class ColumnHandler extends \Anomaly\AddonsModule\Ui\Table\ColumnHandler
{

    /**
     * Handle table columns.
     *
     * @return array
     */
    public function handle()
    {
        return [
            [
                'heading' => 'module::admin.addon',
                'value'   => function (Plugin $entry) {
                        return view('module::plugins/table/plugin', compact('entry'));
                    },
            ],
            [
                'heading' => 'module::admin.authors',
                'value'   => function (Plugin $entry) {
                        return $this->authors($entry);
                    }
            ],
            [
                'heading' => 'module::admin.link',
                'value'   => function (Plugin $entry) {
                        return $this->link($entry);
                    }
            ],
            [
                'heading' => 'module::admin.support',
                'value'   => function (Plugin $entry) {
                        return $this->support($entry);
                    }
            ],
            [
                'heading' => 'module::admin.version',
                'value'   => function (Plugin $entry) {
                        return $this->version($entry);
                    }
            ]
        ];
    }
}
