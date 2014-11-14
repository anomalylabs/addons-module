<?php namespace Anomaly\Streams\Addon\Module\Addons\Ui;

use Anomaly\Streams\Addon\Module\Users\Permission\Permissions;

/**
 * Class AddonsModulePermissions
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Module\Addons\Ui
 */
class AddonsModulePermissions extends Permissions
{

    /**
     * Available permissions.
     *
     * @var array
     */
    protected $permissions = [
        'modules.view',
    ];
}
 