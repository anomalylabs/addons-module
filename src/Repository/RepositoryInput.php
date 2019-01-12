<?php namespace Anomaly\AddonsModule\Repository;

/**
 * Class RepositoryInput
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RepositoryInput
{

    /**
     * Read the repository addon input.
     *
     * @param array $addons
     * @return array
     */
    public function read(array $addons)
    {

        foreach ($addons as &$addon) {

            list($vendor, $name) = explode('/', $addon['name']);
            list($slug, $type) = explode('-', $name);

            $addon['title'] = ucwords(str_humanize($slug));

            $addon['type']   = $type;
            $addon['slug']   = $slug;
            $addon['vendor'] = $vendor;

            $addon['id'] = "{$vendor}.{$type}.{$slug}";
        }

        return $addons;
    }

}
