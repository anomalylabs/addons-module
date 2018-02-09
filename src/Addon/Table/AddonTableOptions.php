<?php namespace Anomaly\AddonsModule\Addon\Table;

use Illuminate\Contracts\Config\Repository;

/**
 * Class AddonTableOptions
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonTableOptions
{

    /**
     * Handle the options.
     *
     * @param AddonTableBuilder $builder
     * @param Repository        $config
     */
    public function handle(AddonTableBuilder $builder, Repository $config)
    {

        // Start with an array
        $builder->setOptions([]);

        $type = $builder->getType();
        $view = $builder->getActiveTableView();

        /**
         * If we are viewing downloaded addons tell
         * the user a little bit about the addon type.
         */
        if ($view->getSlug() == 'downloaded') {
            $builder->setOption('title', "anomaly.module.addons::addon.{$type}.title");
            $builder->setOption('description', "anomaly.module.addons::addon.{$type}.description");
        }

        /**
         * If we are viewing repository addons tell
         * the user a little bit about the repository.
         */
        if ($view->getSlug() !== 'downloaded') {
            $builder->setOption(
                'title',
                $config->get("anomaly.module.addons::repository.{$view->getSlug()}.title")
            );
            $builder->setOption(
                'description',
                $config->get("anomaly.module.addons::repository.{$view->getSlug()}.description")
            );
        }
    }
}
