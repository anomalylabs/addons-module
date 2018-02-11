<?php namespace Anomaly\AddonsModule;

use Anomaly\AddonsModule\Addon\Command\GetOutdatedAddons;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

/**
 * Class AddonsModuleSections
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonsModuleSections
{

    use DispatchesJobs;

    /**
     * Handle the command.
     *
     * @param ControlPanelBuilder $builder
     * @param Request             $request
     * @param Route               $route
     */
    public function handle(ControlPanelBuilder $builder, Request $request, Route $route)
    {
        $view = $request->input('view', $route->parameter('repository', 'downloaded'));

        $moduleUpdates     = $this->dispatch(new GetOutdatedAddons('modules'));
        $extensionsUpdates = $this->dispatch(new GetOutdatedAddons('extensions'));

        $builder->setSections(
            [
                'modules'     => [
                    'matcher' => 'admin/addons/modules*',
                    'label'   => count($moduleUpdates) ?: false,
                    'href'    => 'admin/addons/modules?view=' . $view,
                ],
                'themes'      => [
                    'matcher' => 'admin/addons/themes*',
                    'href'    => 'admin/addons/themes?view=' . $view,
                ],
                'plugins'     => [
                    'matcher' => 'admin/addons/plugins*',
                    'href'    => 'admin/addons/plugins?view=' . $view,
                ],
                'extensions'  => [
                    'matcher' => 'admin/addons/extensions*',
                    'label'   => count($extensionsUpdates) ?: false,
                    'href'    => 'admin/addons/extensions?view=' . $view,
                ],
                'field_types' => [
                    'matcher' => 'admin/addons/field_types*',
                    'href'    => 'admin/addons/field_types?view=' . $view,
                ],
            ]
        );
    }
}
