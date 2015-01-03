<?php namespace Anomaly\AddonsModule\Ui\Table\Module\Handler;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Illuminate\Http\Request;

/**
 * Class EntriesHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Ui\Table\Module\Handler
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
     * @param ModuleCollection $modules
     * @return static
     */
    public function handle(ModuleCollection $modules)
    {

        /**
         * Since we are not using a query / model
         * we will switch the collection scope
         * based on the view here.
         */
        switch ($this->request->get('view')) {

            // Installed
            case 'installed':
                return $modules->installed()->orderByName();
                break;

            // Uninstalled
            case 'uninstalled':
                return $modules->uninstalled()->orderByName();
                break;

            default:
                return $modules->orderByname();
        }
    }
}
