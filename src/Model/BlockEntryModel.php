<?php namespace Streams\Addon\Module\Addons\Model;

use Streams\Addon\Module\Addons\Traits\SyncTrait;
use Streams\Core\Model\Addons\AddonsBlocksEntryModel;

class BlockEntryModel extends AddonsBlocksEntryModel
{
    use SyncTrait;

    /**
     * Minutes to cache queries for.
     *
     * @var int
     */
    protected $cacheMinutes = null;
}
