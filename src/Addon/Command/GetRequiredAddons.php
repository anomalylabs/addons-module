<?php namespace Anomaly\AddonsModule\Addon\Command;

use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class GetRequiredAddons
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetRequiredAddons
{

    use DispatchesJobs;

    /**
     * The type of addons to return.
     *
     * @var string
     */
    protected $type;

    /**
     * Create a new GetRequiredAddons instance.
     *
     * @param null $type
     */
    public function __construct($type = null)
    {
        $this->type = $type;
    }


    /**
     * Handle the command.
     *
     * @return array
     */
    public function handle()
    {
        return array_filter(
            $this->dispatch(new GetAllAddons($this->type)),
            function ($addon) {
                return array_get($addon, 'required', false) !== false;
            }
        );
    }
}
