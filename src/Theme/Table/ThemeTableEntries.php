<?php namespace Anomaly\AddonsModule\Theme\Table;

use Anomaly\Streams\Platform\Addon\Theme\ThemeCollection;
use Anomaly\Streams\Platform\Ui\Table\Table;
use Illuminate\Http\Request;

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
     * The request object.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Create a new ThemeTableEntries instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the table entries.
     *
     * @param Table           $table
     * @param ThemeCollection $themes
     */
    public function handle(Table $table, ThemeCollection $themes)
    {
        /**
         * Since we are not using a query / model
         * we will switch the collection scope
         * based on the view here.
         */
        switch ($this->request->get('view')) {

            // Standard
            case 'standard':
                $themes = $themes->standard();
                break;

            // Uninstalled
            case 'admin':
                $themes = $themes->admin();
                break;

            default:
                break;
        }

        $table->setEntries($themes->orderBySlug());
    }
}
