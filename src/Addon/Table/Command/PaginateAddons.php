<?php namespace Anomaly\AddonsModule\Addon\Table\Command;

use Anomaly\AddonsModule\Addon\Table\AddonTableBuilder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class PaginateAddons
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PaginateAddons
{

    /**
     * The addon table builder.
     *
     * @var AddonTableBuilder
     */
    protected $builder;

    /**
     * Create a new PaginateAddons instance.
     *
     * @param AddonTableBuilder $builder
     */
    public function __construct(AddonTableBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param Request $request
     */
    public function handle(Request $request)
    {
        $addons = $this->builder->getTableEntries();

        $perPage   = $this->builder->getRequestValue(
            'limit',
            $this->builder->getOption('limit') ?: config('streams::system.per_page')
        );
        $pageName  = $this->builder->getTableOption('prefix') . 'page';
        $page      = $request->get($pageName);
        $path      = '/' . $request->path();
        $paginator = new LengthAwarePaginator(
            $addons->forPage($page, $perPage),
            $addons->count(),
            $perPage,
            $page,
            compact('path', 'pageName')
        );

        $pagination          = $paginator->toArray();
        $pagination['links'] = $paginator->appends($request->all())->render();

        $this->builder->addTableData('pagination', $pagination);

        $this->builder->setTableEntries($addons->forPage($page, $perPage));
    }
}
