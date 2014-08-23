<?php namespace Addon\Module\Addons\Controller\Admin;

use Addon\Module\Addons\Model\ExtensionEntryModel;

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