<?php namespace Anomaly\Streams\Addon\Module\Addons\Controller\Admin;

use Streams\Addon\Module\Addons\Model\ThemeEntryModel;

class ThemesController extends AddonsControllerAbstract
{
    /**
     * Create a new ThemesController instance.
     */
    public function __construct()
    {
        $this->addons = new ThemeEntryModel();

        parent::__construct();
    }
}