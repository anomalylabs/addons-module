<?php namespace Anomaly\AddonsModule\Theme\Table\View;

use Anomaly\AddonsModule\Theme\Table\ThemeTableBuilder;
use Anomaly\Streams\Platform\Addon\Theme\ThemeCollection;

/**
 * Class AdminHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Theme\Table\View
 */
class AdminHandler
{

    /**
     * Handle the view query.
     *
     * @param ThemeTableBuilder $builder
     * @param ThemeCollection   $themes
     */
    public function handle(ThemeTableBuilder $builder, ThemeCollection $themes)
    {
        $builder->setTableEntries($themes->admin());
    }
}
