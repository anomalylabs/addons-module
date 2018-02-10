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
                    'is_safe' => true,
                    'heading' => 'module::field.addon.name',
                    'wrapper' => '
                        <strong>{value.title}</strong>
                        {value.pro}
                        {value.downloaded}
                        {value.outdated}
                        <br>
                        <span class="text-muted">{value.name}</span>
                        <br>
                        <small class="text-muted">{value.description}</small>',
                    'value'   => [
                        'name'        => 'entry.name',
                        'title'       => 'entry.title',
                        'description' => 'entry.description',
                        'pro'         => '{% if entry.is_pro %}<span class="tag tag-danger">PRO</span>{% endif %}',
                        'downloaded'  => '{% if entry.downloaded %}<span class="tag tag-primary">' . trans(
                                'anomaly.module.addons::label.downloaded'
                            ) . '</span>{% endif %}',
                        'outdated'    => '{% if entry.has_updates %}<span class="tag tag-warning">' . trans(
                                'anomaly.module.addons::label.outdated'
                            ) . '</span>{% endif %}',
                    ],
                ],
            ]
        );
    }
}
