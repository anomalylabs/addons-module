<?php namespace Anomaly\AddonsModule\Plugin\Ui\Table\Handler;

use Anomaly\Streams\Platform\Addon\Plugin\PluginCollection;
use Illuminate\Http\Request;

/**
 * Class EntriesHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Table\Plugin\Handler
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
     * @param PluginCollection $plugins
     * @return PluginCollection
     */
    public function handle(PluginCollection $plugins)
    {
        return $plugins->orderBySlug();
    }
}
