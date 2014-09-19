<?php

// Go to modules by default
Route::get(
    'admin/addons',
    function () {
        return \Redirect::to('admin/addons/modules');
    }
);

crud('admin/addons/tags', 'Streams\Addon\Module\Addons\Controller\Admin\TagsController');
crud('admin/addons/blocks', 'Streams\Addon\Module\Addons\Controller\Admin\BlocksController');
crud('admin/addons/themes', 'Streams\Addon\Module\Addons\Controller\Admin\ThemesController');
crud('admin/addons/modules', 'Streams\Addon\Module\Addons\Controller\Admin\ModulesController');
crud('admin/addons/extensions', 'Streams\Addon\Module\Addons\Controller\Admin\ExtensionsController');
crud('admin/addons/field_types', 'Streams\Addon\Module\Addons\Controller\Admin\FieldTypesController');

// Install an addon
Route::get(
    'admin/addons/installer/install/{type}/{slug}',
    'Streams\Addon\Module\Addons\Controller\Admin\InstallerController@install'
);

Route::get(
    'admin/addons/installer/uninstall/{type}/{slug}',
    'Streams\Addon\Module\Addons\Controller\Admin\InstallerController@uninstall'
);