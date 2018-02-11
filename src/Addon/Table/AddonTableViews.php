<?php namespace Anomaly\AddonsModule\Addon\Table;

use Anomaly\AddonsModule\Addon\Command\GetOutdatedAddons;
use Anomaly\AddonsModule\Addon\Table\Entries\AllEntries;
use Anomaly\AddonsModule\Addon\Table\Entries\DownloadedEntries;
use Anomaly\AddonsModule\Addon\Table\Entries\RepositoryEntries;
use Anomaly\AddonsModule\Addon\Table\Entries\UpdatesEntries;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class AddonTableViews
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonTableViews
{

    use DispatchesJobs;

    /**
     * Handle the views.
     *
     * @param AddonTableBuilder $builder
     */
    public function handle(AddonTableBuilder $builder, Repository $config)
    {
        $updates = $this->dispatch(new GetOutdatedAddons($builder->getType()));

        $builder->setViews(
            [
                'downloaded' => [
                    'entries' => DownloadedEntries::class,
                ],
                'updates'    => [
                    'entries' => UpdatesEntries::class,
                    'label'   => count($updates) ?: false,
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

        $builder->addView(
            'all',
            [
                'entries' => AllEntries::class,
                'text'    => 'anomaly.module.addons::repository.all.name',
            ]
        );
    }
}
