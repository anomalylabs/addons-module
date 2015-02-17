<?php namespace Anomaly\AddonsModule\Theme\Table;

use Anomaly\Streams\Platform\Addon\Theme\Theme;

/**
 * Class ThemeTableButtons
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Theme\Table
 */
class ThemeTableButtons
{

    /**
     * Return the table buttons.
     */
    public function handle(ThemeTableBuilder $builder)
    {
        $builder->setButtons(
            [
                [
                    'icon'       => 'question-circle',
                    'href'       => function (Theme $entry) {
                        return '/admin/addons/themes/readme/' . $entry->getNamespace();
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
