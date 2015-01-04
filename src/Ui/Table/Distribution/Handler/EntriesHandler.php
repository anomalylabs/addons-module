<?php namespace Anomaly\AddonsModule\Ui\Table\Distribution\Handler;

use Anomaly\Streams\Platform\Addon\Distribution\DistributionCollection;
use Illuminate\Http\Request;

/**
 * Class EntriesHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Ui\Table\Distribution\Handler
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
     * @param DistributionCollection $distributions
     * @return DistributionCollection
     */
    public function handle(DistributionCollection $distributions)
    {
        return $distributions->orderBySlug();
    }
}
