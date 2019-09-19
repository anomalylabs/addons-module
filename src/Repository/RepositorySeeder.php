<?php namespace Anomaly\AddonsModule\Repository;

use Anomaly\AddonsModule\Repository\RepositoryRepository;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;

/**
 * Class RepositorySeeder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RepositorySeeder extends Seeder
{

    /**
     * Run the seeder.
     */
    public function run()
    {
        /* @var RepositoryRepository $repositories */
        $repositories = app(RepositoryRepository::class);

        $repositories->create(
            [
                'url'  => 'https://packages.pyrocms.com',
                'slug' => 'pyro',
                'en'   => [
                    'name'        => 'PRO Addons',
                    'description' => 'First-party addons from the makers of Pyro. Unlimited licensing for <span class="tag tag-danger">PRO</span> addons requires a <a href="https://pyrocms.com/pro" target="_blank">PRO subscription</a>.',
                ],
            ]
        );

        $repositories->create(
            [
                'url'  => 'https://community.pyrocms.com',
                'slug' => 'community',
                'en'   => [
                    'name'        => 'Community Addons',
                    'description' => 'Third-party addons contributed by the community. <a href="https://github.com/pyrocms/community.pyrocms.com/blob/master/satis.json" target="_blank">Add yours to the list.</a>',
                ],
            ]
        );
    }
}
