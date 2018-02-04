<?php namespace Anomaly\AddonsModule\Addon\Table;

use Anomaly\AddonsModule\Addon\Table\Entries\DownloadedEntries;
use Anomaly\AddonsModule\Addon\Table\Entries\RepositoryEntries;

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
    public function handle(AddonTableBuilder $builder)
    {
        $builder->setViews(
            [
                'downloaded' => [
                    'entries' => DownloadedEntries::class,
                ],
            ]
        );

        $repositories = array_filter(
            json_decode(file_get_contents(base_path('composer.json')), true)['repositories'],
            function ($repository) {
                return $repository['type'] == 'composer';
            }
        );

        foreach ($repositories as $repository) {
            $builder->addView(
                md5($repository['url']),
                [
                    'text'    => $repository['name'],
                    'entries' => RepositoryEntries::class,
                ]
            );
        }
    }
}
