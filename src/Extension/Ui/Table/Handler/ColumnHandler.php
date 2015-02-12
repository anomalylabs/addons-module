<?php namespace Anomaly\AddonsModule\Extension\Ui\Table\Handler;

use Anomaly\Streams\Platform\Addon\Extension\Extension;

/**
 * Class ColumnHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Table\Extension
 */
class ColumnHandler extends \Anomaly\AddonsModule\Table\Handler\ColumnHandler
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
                    return view('module::admin/fragments/extension', compact('entry'));
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
