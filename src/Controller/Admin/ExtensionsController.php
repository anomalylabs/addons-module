<?php namespace Streams\Addon\Module\Addons\Controller\Admin;

use Streams\Addon\Module\Addons\Model\ExtensionEntryModel;

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