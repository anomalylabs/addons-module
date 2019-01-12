<?php namespace Anomaly\AddonsModule;

use Anomaly\AddonsModule\Repository\RepositorySeeder;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;

/**
 * Class AddonsModuleSeeder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonsModuleSeeder extends Seeder
{

    /**
     * Run the seeder.
     */
    public function run()
    {
        $this->call(RepositorySeeder::class);
    }
}
