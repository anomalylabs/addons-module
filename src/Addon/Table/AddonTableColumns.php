<?php namespace Anomaly\AddonsModule\Addon\Table;

use Anomaly\AddonsModule\Addon\Contract\AddonInterface;


/**
 * Class AddonTableColumns
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
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
                        <br>
                        <span class="text-muted">{value.name}</span>
                        <br>
                        <small class="text-muted">{value.description}</small>
                        <br>
                        <small>
                            {value.pro}
                            {value.downloaded}
                            {value.outdated}
                        </small>',
                    'value'   => [
                        'name'        => 'entry.name',
                        'title'       => 'entry.display_name',
                        'description' => 'entry.description',
                        'pro'         => function (AddonInterface $entry) {
                            return $entry->isPro() ? '<span class="tag tag-danger">PRO</span>' : '';
                        },
                        'downloaded'  => function (AddonInterface $entry) {
                            return $entry->isDownloaded() ? '<span class="tag tag-primary">' . trans(
                                    'anomaly.module.addons::label.downloaded'
                                ) . '</span>' : '';
                        },
                        'outdated'    => function (AddonInterface $entry) {
                            return $entry->hasUpdates() ? '<span class="tag tag-warning">' . trans(
                                    'anomaly.module.addons::label.outdated'
                                ) . '</span>' : '';
                        },
                    ],
                ],
            ]
        );
    }
}
