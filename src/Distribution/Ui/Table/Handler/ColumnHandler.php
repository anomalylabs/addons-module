<?php namespace Anomaly\AddonsModule\Distribution\Ui\Table\Handler;

use Anomaly\Streams\Platform\Addon\Distribution\Distribution;

/**
 * Class ColumnHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Distribution\Ui\Table
 */
class ColumnHandler extends \Anomaly\AddonsModule\Ui\Table\Handler\ColumnHandler
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
                    return view('module::admin/fragments/distribution', compact('entry'));
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
