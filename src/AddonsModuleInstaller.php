<?php namespace Anomaly\Streams\Addon\Module\Addons;

use Anomaly\Streams\Platform\Addon\Module\ModuleInstaller;

class AddonsModuleInstaller extends ModuleInstaller
{
    protected $installers = [
        'Anomaly\Streams\Addon\Module\Addons\Installer\AddonsFieldInstaller',
        'Anomaly\Streams\Addon\Module\Addons\Installer\ModulesStreamInstaller',
    ];
}
 