<?php namespace Anomaly\AddonsModule\Theme\Table;

use Anomaly\Streams\Platform\Addon\Theme\ThemeCollection;

/**
 * Class ThemeTableEntries
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Theme\Table
 */
class ThemeTableEntries
{

    /**
     * Handle the table entries.
     *
     * @param ThemeTableBuilder $builder
     * @param ThemeCollection   $themes
     */
    public function handle(ThemeTableBuilder $builder, ThemeCollection $themes)
    {
        $builder->setTableEntries($themes);
    }
}
