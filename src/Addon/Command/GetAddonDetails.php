<?php namespace Anomaly\AddonsModule\Addon\Command;

use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class GetAddonDetails
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetAddonDetails
{

    use DispatchesJobs;

    /**
     * The addon ID.
     *
     * @var string
     */
    protected $addon;

    /**
     * Create a new GetAddonDetails instance.
     *
     * @param string $addon
     */
    public function __construct($addon)
    {
        $this->addon = $addon;
    }

    /**
     * Handle the command.
     *
     * @return array|null
     */
    public function handle()
    {
        $parts = explode('.', $this->addon);

        $addons = $this->dispatch(new GetAllAddons($parts[1]));

        return array_first(
            $addons,
            function ($item) {
                return $item['id'] == $this->addon;
            }
        );
    }

}
