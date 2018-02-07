<?php namespace Anomaly\AddonsModule\Addon\Table\Filter;

use Anomaly\AddonsModule\Addon\Table\AddonTableBuilder;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;

/**
 * Class SearchQuery
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SearchQuery
{

    /**
     * Handle the filter "query".
     *
     * @param AddonTableBuilder $builder
     * @param FilterInterface   $filter
     */
    public function handle(AddonTableBuilder $builder, FilterInterface $filter)
    {
        $value = $filter->getValue();

        $type   = $builder->getType();
        $addons = $builder->getTableEntries();

        $addons = $addons->filter(
            function ($addon) use ($value, $type) {

                if (strpos($addon['title'], $value) !== false) {
                    return true;
                }

                if (strpos($addon['name'], $value) !== false) {
                    return true;
                }

                if (isset($addon['description']) && strpos($addon['description'], $value) !== false) {
                    return true;
                }

                return false;
            }
        );

        $builder->setTableEntries($addons);
    }

}
