<?php namespace Anomaly\Streams\Module\Addons\Controller\Admin;

use Anomaly\Streams\Module\Addons\Model\ThemeEntryModel;

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