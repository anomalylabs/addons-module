<?php namespace Anomaly\AddonsModule\Module\Table;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Ui\Table\Table;
use Illuminate\Http\Request;

/**
 * Class ModuleTableEntries
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Module\Table\Handler
 */
class ModuleTableEntries
{

    /**
     * The request object.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Create a new ModuleTableEntries instance.
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
     * @return ModuleCollection
     */
    public function handle(Table $table, ModuleCollection $modules)
    {

        /**
         * Since we are not using a query / model
         * we will switch the collection scope
         * based on the view here.
         */
        switch ($this->request->get('view')) {

            // Installed
            case 'installed':
                $table->setEntries($modules->installed()->orderBySlug());
                break;

            // Uninstalled
            case 'uninstalled':
                $table->setEntries($modules->uninstalled()->orderBySlug());
                break;

            default:
                $table->setEntries($modules->orderBySlug());
        }
    }
}
