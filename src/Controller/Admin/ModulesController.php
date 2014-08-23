<?php namespace Addon\Module\Addons\Controller\Admin;

use Addon\Module\Addons\Model\ModuleEntryModel;

class ModulesController extends AddonsControllerAbstract
{
    /**
     * Create a new ModulesController instance.
     */
    public function __construct()
    {
        $this->addons = new ModuleEntryModel();

        parent::__construct();
    }
}