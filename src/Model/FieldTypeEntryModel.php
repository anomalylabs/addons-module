<?php namespace Streams\Addon\Module\Addons\Model;

use Streams\Addon\Module\Addons\Traits\SyncTrait;
use Streams\Core\Model\Addons\AddonsFieldTypesEntryModel;

class FieldTypeEntryModel extends AddonsFieldTypesEntryModel
{
    use SyncTrait;

    /**
     * Minutes to cache queries for.
     *
     * @var int
     */
    protected $cacheMinutes = null;
}
