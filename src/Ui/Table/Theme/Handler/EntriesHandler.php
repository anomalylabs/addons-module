<?php namespace Anomaly\AddonsModule\Ui\Table\Theme\Handler;

use Anomaly\Streams\Platform\Addon\Theme\ThemeCollection;
use Illuminate\Http\Request;

/**
 * Class EntriesHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Ui\Table\Theme\Handler
 */
class EntriesHandler
{

    /**
     * The request object.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Create a new EntriesHandler instance.
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
     * @param ThemeCollection $themes
     * @return ThemeCollection
     */
    public function handle(ThemeCollection $themes)
    {
        /**
         * Since we are not using a query / model
         * we will switch the collection scope
         * based on the view here.
         */
        switch ($this->request->get('view')) {

            // Public
            case 'public':
                return $themes->regular()->orderBySlug();
                break;

            // Uninstalled
            case 'admin':
                return $themes->admin()->orderBySlug();
                break;

            default:
                return $themes->orderBySlug();
        }
    }
}
