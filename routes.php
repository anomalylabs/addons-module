<?php

// Go to modules by default
Route::get(
    'admin/addons',
    function () {
        return \Redirect::to('admin/addons/modules');
    }
);

// List all addons
Route::get('admin/addons/modules', 'Addon\Module\Addons\Controller\Admin\ModulesController@index');
Route::get('admin/addons/themes', 'Addon\Module\Addons\Controller\Admin\ThemesController@index');
Route::get('admin/addons/blocks', 'Addon\Module\Addons\Controller\Admin\BlocksController@index');
Route::get('admin/addons/extensions', 'Addon\Module\Addons\Controller\Admin\ExtensionsController@index');
Route::get('admin/addons/field_types', 'Addon\Module\Addons\Controller\Admin\FieldTypesController@index');
Route::get('admin/addons/tags', 'Addon\Module\Addons\Controller\Admin\TagsController@index');

// Create
Route::any('admin/addons/modules/create', 'Addon\Module\Addons\Controller\Admin\ModulesController@create');

// Edit
Route::any('admin/addons/modules/edit/{id}', 'Addon\Module\Addons\Controller\Admin\ModulesController@edit');

// Install an addon
Route::get(
    'admin/addons/installer/install/{type}/{slug}',
    'Addon\Module\Addons\Controller\Admin\InstallerController@install'
);

Route::get(
    'admin/addons/installer/uninstall/{type}/{slug}',
    'Addon\Module\Addons\Controller\Admin\InstallerController@uninstall'
);