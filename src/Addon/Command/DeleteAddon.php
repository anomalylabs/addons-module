<?php namespace Anomaly\AddonsModule\Addon\Command;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Illuminate\Contracts\Filesystem\Filesystem;

/**
 * Class DeleteAddon
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DeleteAddon
{

    /**
     * The addon ID.
     *
     * @var string
     */
    protected $addon;

    /**
     * Create a new DeleteAddon instance.
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
     * @param Filesystem      $files
     * @param AddonCollection $addons
     */
    public function handle(Filesystem $files, AddonCollection $addons)
    {
        if ($instance = $addons->get($this->addon)) {

            if (is_dir($instance->getPath())) {
                $files->deleteDirectory($instance->getPath());
            }

            $addons->forget($this->addon);
        }
    }

}
