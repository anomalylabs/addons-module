<?php namespace Anomaly\AddonsModule\Addon;

use Anomaly\AddonsModule\Addon\Command\GetAddonDependents;
use Anomaly\AddonsModule\Addon\Command\GetOutdatedStatus;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class AddonReader
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonReader
{

    use DispatchesJobs;

    /**
     * The addon collection.
     *
     * @var AddonCollection
     */
    protected $addons;

    /**
     * Create a new AddonReader instance.
     *
     * @param AddonCollection $addons
     */
    public function __construct(AddonCollection $addons)
    {
        $this->addons = $addons;
    }

    /**
     * Read environmental addon information.
     *
     * @param array $addons
     */
    public function read(array $addons)
    {

        $composer = json_decode(file_get_contents(base_path('composer.json')), true);
        $lock     = json_decode(file_get_contents(base_path('composer.lock')), true);

        foreach ($addons as &$addon) {

            $addon['downloaded'] = false;

            $addon['required'] = isset($composer['require'][$addon['name']]);

            $addon['constraint'] = array_get($composer['require'], $addon['name'], null);

            if ($instance = $this->addons->get($addon['id'])) {

                $addon['downloaded'] = true;
                $addon['readme']     = $instance->getReadme();
                $addon['path']       = $instance->getAppPath();
                $addon['lock']       = $instance->getComposerLock();

                $addon['has_updates'] = $this->dispatch(new GetOutdatedStatus($addon, $composer));
                $addon['dependents']  = $this->dispatch(new GetAddonDependents($addon, $lock));

                if ($instance instanceof Module || $instance instanceof Extension) {
                    $addon['enabled']   = $instance->isEnabled();
                    $addon['installed'] = $instance->isInstalled();
                }
            }
        }

        return $addons;
    }
}
