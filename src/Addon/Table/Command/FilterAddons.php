<?php namespace Anomaly\AddonsModule\Addon\Table\Command;

use Anomaly\AddonsModule\Addon\Table\AddonTableBuilder;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Illuminate\Contracts\Container\Container;

/**
 * Class FilterAddons
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FilterAddons
{

    /**
     * The addon table builder.
     *
     * @var AddonTableBuilder
     */
    protected $builder;

    /**
     * Create a new FilterAddons instance.
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
     * @param Container $container
     */
    public function handle(Container $container)
    {
        /* @var FilterInterface $filter */
        foreach ($this->builder->getActiveTableFilters() as $filter) {

            $container->call(
                $filter->getQuery(),
                [
                    'filter'  => $filter,
                    'builder' => $this->builder,
                ],
                'handle'
            );
        }
    }
}
