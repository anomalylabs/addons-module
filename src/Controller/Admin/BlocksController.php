<?php namespace Anomaly\Streams\Addon\Module\Addons\Controller\Admin;

use Streams\Addon\Module\Addons\Model\BlockEntryModel;

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