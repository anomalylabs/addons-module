<?php namespace Anomaly\AddonsModule\Addon\Table\View;

use Anomaly\AddonsModule\Addon\Contract\AddonRepositoryInterface;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class UpdatesQuery
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class UpdatesQuery
{

    /**
     * Handle the query.
     *
     * @param Builder                  $query
     * @param AddonRepositoryInterface $addons
     */
    public function handle(Builder $query, AddonRepositoryInterface $addons)
    {
        $downloaded = $addons->downloaded();

        $query->whereIn('namespace', $downloaded->updates()->pluck('namespace')->all());
    }

}
