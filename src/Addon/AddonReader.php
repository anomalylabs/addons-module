<?php namespace Anomaly\AddonsModule\Addon;

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

        foreach ($addons as &$addon) {

            $addon['downloaded'] = false;

            if ($instance = $this->addons->get($addon['id'])) {

                $addon['downloaded'] = true;
                $addon['readme']     = $instance->getReadme();
                $addon['path']       = $instance->getAppPath();
                $addon['lock']       = $instance->getComposerLock();

                if ($constraint = array_get($composer['require'], $addon['name'])) {
                    $addon['constraint'] = $constraint;
                }

                $addon['outdated'] = $this->dispatch(new GetOutdatedStatus($addon, $composer));

                if ($instance instanceof Module || $instance instanceof Extension) {
                    $addon['enabled']   = $instance->isEnabled();
                    $addon['installed'] = $instance->isInstalled();
                }
            }
        }

        return $addons;
    }
}
