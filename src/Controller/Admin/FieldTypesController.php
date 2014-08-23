<?php namespace Addon\Module\Addons\Controller\Admin;

use Addon\Module\Addons\Model\FieldTypeEntryModel;

class FieldTypesController extends AddonsControllerAbstract
{
    /**
     * Create a new ExtensionController instance.
     */
    public function __construct()
    {
        $this->addons = new FieldTypeEntryModel();

        parent::__construct();
    }
}