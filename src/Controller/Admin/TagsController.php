<?php namespace Anomaly\Streams\Module\Addons\Controller\Admin;

use Anomaly\Streams\Module\Addons\Model\TagEntryModel;

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