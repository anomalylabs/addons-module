<?php namespace Anomaly\AddonsModule\Ui\Table\Extension\Handler;

use Anomaly\Streams\Platform\Addon\Extension\Extension;

/**
 * Class ColumnHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Ui\Table\Extension
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
                'value'   => function (Extension $entry) {
                        return view('module::extensions/table/extension', compact('entry'));
                    },
            ],
            [
                'heading' => 'module::admin.authors',
                'value'   => function (Extension $entry) {
                        return $this->authors($entry);
                    }
            ],
            [
                'heading' => 'module::admin.link',
                'value'   => function (Extension $entry) {
                        return $this->link($entry);
                    }
            ],
            [
                'heading' => 'module::admin.support',
                'value'   => function (Extension $entry) {
                        return $this->support($entry);
                    }
            ],
            [
                'heading' => 'module::admin.version',
                'value'   => function (Extension $entry) {
                        return $this->version($entry);
                    }
            ]
        ];
    }
}
