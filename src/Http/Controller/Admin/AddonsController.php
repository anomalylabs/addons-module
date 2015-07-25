<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;

/**
 * Class AddonsController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\AddonsModule\Http\Controller\Admin
 */
class AddonsController extends AdminController
{

    /**
     * Show the details of an addon.
     *
     * @param BreadcrumbCollection $breadcrumbs
     * @param AddonCollection      $addons
     * @param                      $addon
     * @return string
     */
    public function view(BreadcrumbCollection $breadcrumbs, AddonCollection $addons, $addon)
    {
        /* @var Addon $addon */
        $addon = $addons->merged()->get($addon);

        $breadcrumbs->put($addon->getTitle(), '#');

        $json = $addon->getComposerJson();

        if (file_exists($readme = $addon->getPath('README.md'))) {
            $readme = file_get_contents($readme);
        }

        if (file_exists($license = $addon->getPath('LICENSE.md'))) {
            $license = file_get_contents($license);
        }

        return view('module::admin/addon', compact('addon', 'json', 'readme', 'license'))->render();
    }
}
