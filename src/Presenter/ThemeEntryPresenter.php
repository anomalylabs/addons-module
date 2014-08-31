<?php namespace Streams\Addon\Module\Addons\Presenter;

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
        return \Theme::find($this->resource->slug)->name;
    }

    /**
     * Return the addon description.
     *
     * @return mixed
     */
    public function description()
    {
        return \Theme::find($this->resource->slug)->description;
    }
}