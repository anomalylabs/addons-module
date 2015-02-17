<?php namespace Anomaly\AddonsModule\Plugin\Table;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;

/**
 * Class PluginTableButtons
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Plugin\Table
 */
class PluginTableButtons
{

    /**
     * Return the table buttons.
     */
    public function handle(PluginTableBuilder $builder)
    {
        $builder->setButtons(
            [
                [
                    'icon'       => 'question-circle',
                    'href'       => function (Plugin $entry) {
                        return '/admin/addons/plugins/readme/' . $entry->getNamespace();
                    },
                    'attributes' => [
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-lg'
                    ]
                ]
            ]
        );
    }
}
