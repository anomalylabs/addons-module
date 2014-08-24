<?php namespace Streams\Addon\Module\Addons\Model;

use Streams\Addon\Module\Addons\Traits\SyncTrait;
use Streams\Core\Model\Addons\AddonsTagsEntryModel;

class TagEntryModel extends AddonsTagsEntryModel
{
    use SyncTrait;

    /**
     * Minutes to cache queries for.
     *
     * @var int
     */
    protected $cacheMinutes = null;
}
