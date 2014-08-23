<?php namespace Addon\Module\Addons\Presenter;

use Streams\Core\Presenter\EntryPresenter;

class ThemeEntryPresenter extends EntryPresenter
{
    /**
     * Return the addon name.
     *
     * @return mixed
     */
    public function name()
    {
        return \Theme::get($this->resource->slug)->name;
    }

    /**
     * Return the addon description.
     *
     * @return mixed
     */
    public function description()
    {
        return \Theme::get($this->resource->slug)->description;
    }
}