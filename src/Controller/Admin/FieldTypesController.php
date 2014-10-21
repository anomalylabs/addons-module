<?php namespace Anomaly\Streams\Module\Addons\Controller\Admin;

use Anomaly\Streams\Module\Addons\Model\FieldTypeEntryModel;

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