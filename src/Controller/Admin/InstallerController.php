<?php namespace Anomaly\Streams\Addon\Module\Addons\Controller\Admin;

use Anomaly\Streams\Platform\Http\Controller\AdminController;

class InstallerController extends AdminController
{
    /**
     * Install an addon.
     *
     * @param $type
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function install($type, $slug)
    {
        $messages = app('streams.messages');

        $installer = app('Streams\Platform\Addon\Module\ModuleService');

        if ($installer->install(app("streams.module.{$slug}"))) {
            $messages->add('success', trans('**Success** perfect!'));
        } else {
            $messages->add('error', trans('**Error** shit!'));
        }

        $messages->flash();

        return \Redirect::back();
    }

    /**
     * Uninstall an addon.
     *
     * @param $type
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uninstall($type, $slug)
    {
        $messages = app('streams.messages');

        $installer = app('Streams\Platform\Addon\Module\ModuleService');

        if ($installer->uninstall(app("streams.module.{$slug}"))) {
            $messages->add('success', trans('**Success** perfect!'));
        } else {
            $messages->add('error', trans('**Error** shit!'));
        }

        $messages->flash();

        return \Redirect::back();
    }
}