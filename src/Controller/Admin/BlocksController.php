<?php namespace Anomaly\Streams\Module\Addons\Controller\Admin;

use Anomaly\Streams\Module\Addons\Model\BlockEntryModel;

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