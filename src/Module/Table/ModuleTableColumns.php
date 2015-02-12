<?php namespace Anomaly\AddonsModule\Module\Table;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class ModuleTableColumns
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Module\Table
 */
class ModuleTableColumns extends \Anomaly\AddonsModule\Table\Handler\ColumnHandler
{

    /**
     * Return the table columns.
     **/
    public function handle(ModuleTableBuilder $builder)
    {
        $builder->setColumns(
            [
                [
                    'heading' => 'module::admin.addon',
                    'value'   => function (Module $entry) {
                        return view('module::admin/fragments/module', compact('entry'));
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
            ]
        );
    }
}
