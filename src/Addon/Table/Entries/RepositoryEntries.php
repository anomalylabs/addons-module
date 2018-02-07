<?php namespace Anomaly\AddonsModule\Addon\Table\Entries;

use Anomaly\AddonsModule\Addon\Table\AddonTableBuilder;
use Anomaly\AddonsModule\Addon\Table\Command\FilterAddons;
use Anomaly\AddonsModule\Addon\Table\Command\GetRepositoryAddons;
use Anomaly\Streams\Platform\Support\Collection;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class RepositoryEntries
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RepositoryEntries
{

    use DispatchesJobs;

    /**
     * Handle the command.
     *
     * @param AddonTableBuilder $builder
     * @param Repository        $cache
     */
    public function handle(AddonTableBuilder $builder, Repository $cache)
    {
        $view = $builder->getActiveTableView();

        $addons = $cache->remember(
            'anomaly.module.addons::addons.' . $view->getSlug() . '.' . $builder->getType(),
            10,
            function () use ($builder) {
                return $addons = $this->dispatch(new GetRepositoryAddons($builder));;
            }
        );

        $addons = new Collection($addons);

        $perPage   = $builder->getRequestValue(
            'limit',
            $builder->getOption('limit') ?: config('streams::system.per_page')
        );
        $pageName  = $builder->getTableOption('prefix') . 'page';
        $page      = app('request')->get($pageName);
        $path      = '/' . app('request')->path();
        $paginator = new LengthAwarePaginator(
            $addons->forPage($page, $perPage),
            $addons->count(),
            $perPage,
            $page,
            compact('path', 'pageName')
        );

        $pagination          = $paginator->toArray();
        $pagination['links'] = $paginator->appends(app('request')->all())->render();

        $builder->addTableData('pagination', $pagination);

        $builder->setTableEntries($addons->forPage($page, $perPage));

        $this->dispatch(new FilterAddons($builder));
    }
}
