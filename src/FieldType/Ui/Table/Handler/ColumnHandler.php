<?php namespace Anomaly\AddonsModule\FieldType\Ui\Table\Handler;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class ColumnHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\FieldType\Ui\Table
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
                'value'   => function (FieldType $entry) {
                    return view('module::admin/fragments/field_type', compact('entry'));
                },
            ],
            [
                'heading' => 'module::admin.authors',
                'value'   => function (FieldType $entry) {
                    return $this->authors($entry);
                }
            ],
            [
                'heading' => 'module::admin.link',
                'value'   => function (FieldType $entry) {
                    return $this->link($entry);
                }
            ],
            [
                'heading' => 'module::admin.support',
                'value'   => function (FieldType $entry) {
                    return $this->support($entry);
                }
            ],
            [
                'heading' => 'module::admin.version',
                'value'   => function (FieldType $entry) {
                    return $this->version($entry);
                }
            ]
        ];
    }
}
