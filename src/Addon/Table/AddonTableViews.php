<?php namespace Anomaly\AddonsModule\Addon\Table;

use Anomaly\AddonsModule\Addon\Contract\AddonRepositoryInterface;
use Anomaly\AddonsModule\Addon\Table\View\ProQuery;
use Anomaly\AddonsModule\Addon\Table\View\UpdatesQuery;

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
     * Handle the command.
     *
     * @param AddonTableBuilder $builder
     * @param AddonRepositoryInterface $addons
     */
    public function handle(
        AddonTableBuilder $builder,
        AddonRepositoryInterface $addons
    ) {
        $builder->setViews(
            [
                'all',
//                'pro' => [
//                    'query' => ProQuery::class,
//                ],
                'available',
                'downloaded',
                'updates' => [
                    'query' => UpdatesQuery::class,
                    'label' => $addons->cache(
                        'updates',
                        60 * 60,
                        function () use ($addons) {
                            return $addons->downloaded()->updates()->count();
                        }
                    ) ?: false,
                ],
            ]
        );
    }
}
