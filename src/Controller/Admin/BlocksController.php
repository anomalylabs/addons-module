<?php namespace Addon\Module\Addons\Controller\Admin;

use Addon\Module\Addons\Model\BlockEntryModel;

class BlocksController extends AddonsControllerAbstract
{
    /**
     * Create a new BlocksController instance.
     */
    public function __construct()
    {
        $this->addons = new BlockEntryModel();

        parent::__construct();
    }
}