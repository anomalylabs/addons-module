<?php namespace Anomaly\AddonsModule\Addon;

/**
 * Class AddonNormalizer
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonNormalizer
{

    /**
     * Normalize the addons.
     *
     * @param array $addons
     * @return array
     */
    public function normalize(array $addons)
    {
        foreach ($addons as &$addon) {

            list($vendor, $name) = explode('/', $addon['name']);
            list($slug, $type) = explode('-', $name);

            $addon['vendor'] = $vendor;
            $addon['slug']   = $slug;
            $addon['type']   = $type;

            $addon['id'] = "{$vendor}.{$type}.{$slug}";

            $addon['title'] = ucwords(str_humanize($slug));

            $addon['is_pro'] = in_array('https://pyrocms.com/pro/license', array_get($addon, 'license', []));
        }

        return $addons;
    }
}
