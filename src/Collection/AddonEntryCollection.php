<?php namespace Anomaly\Streams\Module\Addons\Collection;

use Streams\Core\Entry\Collection\EntryCollection;

class AddonEntryCollection extends EntryCollection
{
    /**
     * Find an item by it's slug attribute.
     *
     * @param $slug
     * @return null
     */
    public function findBySlug($slug) {
        foreach ($this->items as $item) {
            if ($item->slug == $slug) {
                return $item;
            }
        }

        return null;
    }
}