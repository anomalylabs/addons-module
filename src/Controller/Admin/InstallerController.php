<?php namespace Streams\Addon\Module\Addons\Controller\Admin;

use Streams\Core\Http\Controller\AdminController;

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
        $manager = '\\' . \Str::studly($type);

        if ($manager::install($slug)) {
            $this->messages->add('success', \Lang::trans('**Success** perfect!'));
        } else {
            $this->messages->add('error', \Lang::trans('**Error** shit!'));
        }

        $this->messages->flash();

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
        $manager = '\\' . \Str::studly($type);

        if ($manager::uninstall($slug)) {
            $this->messages->add('success', \Lang::trans('**Success** perfect!'));
        } else {
            $this->messages->add('error', \Lang::trans('**Error** shit!'));
        }

        $this->messages->flash();

        return \Redirect::back();
    }
}