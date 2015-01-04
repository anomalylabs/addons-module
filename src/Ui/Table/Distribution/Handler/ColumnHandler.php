<?php namespace Anomaly\AddonsModule\Ui\Table\Distribution\Handler;

use Anomaly\Streams\Platform\Addon\Distribution\Distribution;

/**
 * Class ColumnHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Ui\Table\Distribution
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
                'value'   => function (Distribution $entry) {
                        return view('module::distributions/table/distribution', compact('entry'));
                    },
            ],
            [
                'heading' => 'module::admin.authors',
                'value'   => function (Distribution $entry) {
                        return $this->authors($entry);
                    }
            ],
            [
                'heading' => 'module::admin.link',
                'value'   => function (Distribution $entry) {
                        return $this->link($entry);
                    }
            ],
            [
                'heading' => 'module::admin.support',
                'value'   => function (Distribution $entry) {
                        return $this->support($entry);
                    }
            ],
            [
                'heading' => 'module::admin.version',
                'value'   => function (Distribution $entry) {
                        return $this->version($entry);
                    }
            ]
        ];
    }
}
