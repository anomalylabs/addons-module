<?php namespace Anomaly\AddonsModule\Addon\Table\View;

use Anomaly\AddonsModule\Addon\Contract\AddonRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ProQuery
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ProQuery
{

    /**
     * Handle the query.
     *
     * @param Builder $query
     * @param AddonRepositoryInterface $addons
     */
    public function handle(Builder $query)
    {
        $query->where('licenses', 'LIKE', '%pyrocms.com/pro/license%');
    }

}
