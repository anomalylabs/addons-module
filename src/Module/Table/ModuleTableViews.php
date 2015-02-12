<?php namespace Anomaly\AddonsModule\Module\Table;

/**
 * Class ModuleTableViews
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Module\Table\Handler
 */
class ModuleTableViews
{

    /**
     * Handle table views.
     *
     * @return array
     */
    public function handle(ModuleTableBuilder $builder)
    {
        $builder->setViews(
            [
                'all',
                'installed'   => [
                    'text' => 'module::admin.installed',
                ],
                'uninstalled' => [
                    'text' => 'module::admin.uninstalled',
                ]
            ]
        );
    }
}
