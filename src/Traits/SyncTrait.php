<?php namespace Anomaly\Streams\Addon\Module\Addons\Traits;

use Streams\Addon\Module\Addons\Collection\AddonEntryCollection;

trait SyncTrait
{
    /**
     * Syn addons from file system to database and back.
     */
    public function sync()
    {
        $class   = explode('\\', get_called_class());
        $type = str_plural(snake_case(str_replace('EntryModel', null, end($class))));

        $existingAddons = app()->make("streams.{$type}")->all();
        $databaseAddons = $this->all();

        // Sync TO the database
        foreach ($existingAddons as $addon) {
            if (!$databaseAddons->findBySlug($addon->slug)) {
                $this->insert(
                    array(
                        'slug' => $addon->slug,
                    )
                );
            }
        }
    }

    /**
     * Return a new AddonEntryCollection instance.
     *
     * @param array $items
     * @return AddonEntryCollection
     */
    public function newCollection(array $items = [])
    {
        return new AddonEntryCollection($items);
    }
}