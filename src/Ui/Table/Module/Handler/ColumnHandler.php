<?php namespace Anomaly\AddonsModule\Ui\Table\Module\Handler;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class ColumnHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Ui\Table\Module
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
                'value'   => function (Module $entry) {
                        return view('module::modules/table/module', compact('entry'));
                    },
            ],
            [
                'heading' => 'module::admin.authors',
                'value'   => function (Module $entry) {
                        return $this->authors($entry);
                    }
            ],
            [
                'heading' => 'module::admin.link',
                'value'   => function (Module $entry) {
                        return $this->link($entry);
                    }
            ],
            [
                'heading' => 'module::admin.support',
                'value'   => function (Module $entry) {
                        return $this->support($entry);
                    }
            ],
            [
                'heading' => 'module::admin.version',
                'value'   => function (Module $entry) {
                        return $this->version($entry);
                    }
            ]
        ];
    }
}
