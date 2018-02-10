<?php namespace Anomaly\AddonsModule\Addon;

use Anomaly\AddonsModule\Addon\Command\GetOutdatedStatus;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class AddonNormalizer
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonNormalizer
{

    use DispatchesJobs;

    /**
     * The addon collection.
     *
     * @var AddonCollection
     */
    protected $addons;

    /**
     * Create a new AddonNormalizer instance.
     *
     * @param AddonCollection $addons
     */
    public function __construct(AddonCollection $addons)
    {
        $this->addons = $addons;
    }

    /**
     * Normalize the addons.
     *
     * @param array $addons
     * @return array
     */
    public function normalize(array $addons)
    {
        $composer = json_decode(file_get_contents(base_path('composer.json')));

        foreach ($addons as &$addon) {

            list($vendor, $name) = explode('/', $addon['name']);
            list($slug, $type) = explode('-', $name);

            $addon['vendor'] = $vendor;
            $addon['slug']   = $slug;
            $addon['type']   = $type;

            $addon['id'] = "{$vendor}.{$type}.{$slug}";

            $addon['title'] = ucwords(str_humanize($slug));

            $addon['is_pro'] = in_array('https://pyrocms.com/pro/license', array_get($addon, 'license', []));

            if ($instance = $this->addons->get($addon['id'])) {

                $addon['downloaded'] = true;
                $addon['readme']     = $instance->getReadme();
                $addon['path']       = $instance->getAppPath();

                $lock = $instance->getComposerLock();

                $addon['version'] = $lock->version;

                $addon['outdated'] = $this->dispatch(new GetOutdatedStatus($addon));

                if ($instance instanceof Module || $instance instanceof Extension) {
                    $addon['enabled']   = $instance->isEnabled();
                    $addon['installed'] = $instance->isInstalled();
                }
            }
        }

        return $addons;
    }
}
