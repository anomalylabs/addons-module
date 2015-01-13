<?php namespace Anomaly\AddonsModule\Module\Ui\Table\Handler;

/**
 * Class ViewHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Module\Ui\Table\Handler
 */
class ViewHandler
{

    /**
     * Handle table views.
     *
     * @return array
     */
    public function handle()
    {
        return [
            'all',
            'installed'   => [
                'text' => 'module::admin.installed',
            ],
            'uninstalled' => [
                'text' => 'module::admin.uninstalled',
            ]
        ];
    }
}
