<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Addon\Command\BuildDocumentationNavigation;
use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
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
     * Go to modules.
     *
     * @param Redirector $redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    public function modules(Redirector $redirect)
    {
        return $redirect->to('admin/addons/modules');
    }

    /**
     * Show the details of an addon.
     *
     * @param BreadcrumbCollection $breadcrumbs
     * @param AddonCollection      $addons
     * @param                      $addon
     * @return string
     */
    public function view(BreadcrumbCollection $breadcrumbs, Request $request, AddonCollection $addons, $addon)
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

        return view('module::admin/addon/index', compact('addon', 'json', 'readme', 'license', 'request'))->render();
    }

    /**
     * Display addon documentation.
     *
     * @param BreadcrumbCollection $breadcrumbs
     * @param Request              $request
     * @param AddonCollection      $addons
     * @param Filesystem           $files
     * @param                      $addon
     * @param null                 $path
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function documentation(
        BreadcrumbCollection $breadcrumbs,
        Request $request,
        AddonCollection $addons,
        Filesystem $files,
        $addon,
        $path = null
    ) {
        /* @var Addon $addon */
        $addon = $addons->merged()->get($addon);

        $breadcrumbs->put(
            $addon->getTitle(),
            str_replace(
                'documentation',
                'view',
                $request->route()->getCompiled()->getStaticPrefix()
            ) . '/' . $addon->getNamespace()
        );
        $breadcrumbs->put('module::breadcrumb.documentation', '#');

        if ($files->exists($navigation = $addon->getPath('documentation/documentation.php'))) {
            $navigation = $files->getRequire($navigation);
        } else {
            return redirect()->back();
        }

        if (!$path) {

            $categories = array_keys($navigation);
            $default    = array_shift($navigation);
            $sections   = array_keys(array_get($default, 'sections', []));

            return redirect($request->path() . '/' . array_shift($categories) . '/' . array_shift($sections));
        }

        if ($files->exists($addon->getPath('documentation/' . $path . '.md'))) {
            $content = $files->get($addon->getPath('documentation/' . $path . '.md'));
        }

        return view(
            'module::admin/documentation/index',
            compact('addon', 'navigation', 'request', 'content')
        )->render();
    }
}
