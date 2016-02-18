<?php namespace Anomaly\AddonsModule\Addon\Table;

use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class AddonTableColumns
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Addon\Table
 */
class AddonTableColumns implements SelfHandling
{

    /**
     * Handle the command.
     *
     * @param AddonTableBuilder $builder
     */
    public function handle(AddonTableBuilder $builder)
    {
        $builder->setColumns(
            [
                [
                    'heading' => 'module::field.name.name',
                    'value'   => 'entry.title'
                ],
                [
                    'heading' => 'module::field.description.name',
                    'value'   => 'entry.description'
                ]
            ]
        );
    }
}
