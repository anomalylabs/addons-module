<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Addon\Table\AddonTableBuilder;
use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Illuminate\Routing\Redirector;

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
     * Return an index of existing addons.
     *
     * @param AddonTableBuilder $table
     * @param Redirector        $redirector
     * @param null              $type
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function index(AddonTableBuilder $table, Redirector $redirector, $type = null)
    {
        if (!$type) {
            return $redirector->to('admin/addons/modules');
        }

        return $table->setOption('addon_type', $type)->render();
    }

    /**
     * Show the details of an addon.
     *
     * @param AddonCollection $addons
     * @param                 $type
     * @param                 $namespace
     * @return string
     */
    public function show(AddonCollection $addons, $type, $namespace)
    {
        /* @var Addon $addon */
        $addon = $addons->{$type}->get($namespace);

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
