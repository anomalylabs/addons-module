<?php namespace Anomaly\Streams\Module\Addons\Controller\Admin;

use Anomaly\Streams\Module\Addons\Model\ExtensionEntryModel;

class ExtensionsController extends AddonsControllerAbstract
{
    /**
     * Create a new ExtensionsController instance.
     */
    public function __construct()
    {
        $this->addons = new ExtensionEntryModel();

        parent::__construct();
    }
}