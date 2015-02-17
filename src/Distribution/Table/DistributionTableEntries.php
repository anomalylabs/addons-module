<?php namespace Anomaly\AddonsModule\Distribution\Table;

use Anomaly\Streams\Platform\Addon\Distribution\DistributionCollection;
use Anomaly\Streams\Platform\Ui\Table\Table;
use Illuminate\Http\Request;

/**
 * Class EntriesHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Distribution\Table
 */
class DistributionTableEntries
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
     * @param Table                  $table
     * @param DistributionCollection $distributions
     */
    public function handle(Table $table, DistributionCollection $distributions)
    {
        $table->setEntries($distributions->orderBySlug());
    }
}
