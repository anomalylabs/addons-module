<?php namespace Streams\Addon\Module\Addons\Controller\Admin;

use Streams\Addon\Module\Addons\Model\TagEntryModel;

class TagsController extends AddonsControllerAbstract
{
    /**
     * Create a new TagsController instance.
     */
    public function __construct()
    {
        $this->addons = new TagEntryModel();

        parent::__construct();
    }
}