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
                'name' => [
                    'is_safe' => true,
                    'heading' => 'module::field.addon.name',
                    'wrapper' => '
                        <img src="{value.icon}" width="96" align="left" style="margin-right: 1rem;">
                        <strong>{value.title}</strong>
                        <br>
                        <span class="text-muted">{value.name}</span>
                        <br>
                        <small class="text-muted">{value.description}</small>
                        <div>
                            <small>
                                {value.pro}
                                {value.downloaded}
                                {value.outdated}
                            </small>
                        </div>',
                    'value'   => [
                        'icon'        => 'entry.icon',
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
