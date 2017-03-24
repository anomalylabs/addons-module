<?php namespace Anomaly\AddonsModule\Addon\Table\Command;

use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class GetComposerJson
 */
class GetComposerJson
{

    use DispatchesJobs;

    /**
     * Addon model
     *
     * @var Addon
     */
    protected $addon;

    /**
     * Create the GetComposerJson instance
     *
     * @param Addon $addon Addon model
     */
    public function __construct($addon)
    {
        $this->addon = $addon;
    }

    /**
     * Handle the command
     */
    public function handle()
    {
        // if (array_get($_GET, 'view') != 'packages')
        // {
        //     return $this->addon->getComposerJson();
        // }

        $this->dispatch(new FetchComposerJson($this->addon->package));

        return;
    }
}
