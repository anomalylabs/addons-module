<?php namespace Anomaly\Streams\Module\Addons\Model;

use Anomaly\Streams\Module\Addons\Traits\SyncTrait;
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
