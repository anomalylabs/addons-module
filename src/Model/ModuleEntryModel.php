<?php namespace Addon\Module\Addons\Model;

use Addon\Module\Addons\Presenter\ModuleEntryPresenter;
use Addon\Module\Addons\Traits\SyncTrait;
use Streams\Core\Model\Addons\AddonsModulesEntryModel;

class ModuleEntryModel extends AddonsModulesEntryModel
{
    use SyncTrait;

    /**
     * Return a new presenter instance.
     *
     * @param $resource
     * @return ModuleEntryPresenter|\Streams\Presenter\EloquentPresenter
     */
    public function newPresenter($resource)
    {
        return new ModuleEntryPresenter($resource);
    }
}
