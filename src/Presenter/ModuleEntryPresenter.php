<?php namespace Addon\Module\Addons\Presenter;

use Streams\Core\Entry\Presenter\EntryPresenter;

class ModuleEntryPresenter extends EntryPresenter
{
    /**
     * Return the addon name.
     *
     * @return mixed
     */
    public function name()
    {
        return \Module::get($this->resource->slug)->name;
    }

    /**
     * Return the addon description.
     *
     * @return mixed
     */
    public function description()
    {
        return \Module::get($this->resource->slug)->description;
    }
}