<?php namespace Anomaly\Streams\Addon\Module\Addons\Http\Controller\Admin;

use Anomaly\Streams\Addon\Module\Addons\Ui\Table\TagTable;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class TagsController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Theme\Addons\Http\Controllers\Admin
 */
class TagsController extends AdminController
{

    /**
     * Return an index of existing tags.
     *
     * @param TagTable $ui
     * @return mixed|null
     */
    public function index(TagTable $ui)
    {
        return $ui->render();
    }
}
 