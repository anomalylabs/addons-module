<?php namespace Anomaly\AddonsModule\Addon\Table;

use Anomaly\AddonsModule\Addon\Table\Entries\DownloadedEntries;
use Anomaly\AddonsModule\Addon\Table\Entries\RepositoryEntries;
use Anomaly\AddonsModule\Addon\Table\Entries\UpdatesEntries;
use Illuminate\Contracts\Config\Repository;

/**
 * Class AddonTableViews
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonTableViews
{

    /**
     * Handle the views.
     *
     * @param AddonTableBuilder $builder
     */
    public function handle(AddonTableBuilder $builder, Repository $config)
    {
        $builder->setViews(
            [
                'downloaded' => [
                    'entries' => DownloadedEntries::class,
                ],
                'updates' => [
                    'entries' => UpdatesEntries::class,
                ],
            ]
        );

        foreach ($config->get('anomaly.module.addons::repository', []) as $slug => $repository) {
            $builder->addView(
                $slug,
                [
                    'text'    => $repository['name'],
                    'entries' => RepositoryEntries::class,
                ]
            );
        }
    }
}
