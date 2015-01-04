<?php namespace Anomaly\AddonsModule\Ui\Table\Theme\Handler;

/**
 * Class ViewHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Ui\Table\Module\Handler
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
            'public' => [
                'text' => 'module::admin.public',
            ],
            'admin'  => [
                'text' => 'module::admin.admin',
            ]
        ];
    }
}
