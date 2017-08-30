<?php namespace Anomaly\AddonsModule\Addon\Table;


/**
 * Class AddonTableColumns
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddonTableColumns
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
                    'heading' => 'module::field.addon.name',
                    'wrapper' => '
                        <strong>{value.name}</strong>
                        <br>
                        <small class="text-muted">{value.description}</small>',
                    'value'   => [
                        'name'        => 'entry.title',
                        'description' => 'entry.description',
                    ],
                ],
                [
                    'heading' => 'module::field.version.name',
                    'value'   => 'entry.getComposerLock().version',
                ],
            ]
        );
    }
}
