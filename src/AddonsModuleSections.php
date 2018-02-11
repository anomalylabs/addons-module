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

        $updates = [
            'modules'     => $this->dispatch(new GetOutdatedAddons('modules')),
            'themes'      => $this->dispatch(new GetOutdatedAddons('themes')),
            'plugins'     => $this->dispatch(new GetOutdatedAddons('plugins')),
            'extensions'  => $this->dispatch(new GetOutdatedAddons('extensions')),
            'field_types' => $this->dispatch(new GetOutdatedAddons('field_types')),
        ];

        $builder->setSections(
            [
                'modules'     => [
                    'matcher' => 'admin/addons/modules*',
                    'label'   => count($updates['modules']) ?: false,
                    'href'    => 'admin/addons/modules?view=' . $view,
                ],
                'themes'      => [
                    'matcher' => 'admin/addons/themes*',
                    'label'   => count($updates['themes']) ?: false,
                    'href'    => 'admin/addons/themes?view=' . $view,
                ],
                'plugins'     => [
                    'matcher' => 'admin/addons/plugins*',
                    'label'   => count($updates['plugins']) ?: false,
                    'href'    => 'admin/addons/plugins?view=' . $view,
                ],
                'extensions'  => [
                    'matcher' => 'admin/addons/extensions*',
                    'label'   => count($updates['extensions']) ?: false,
                    'href'    => 'admin/addons/extensions?view=' . $view,
                ],
                'field_types' => [
                    'matcher' => 'admin/addons/field_types*',
                    'label'   => count($updates['field_types']) ?: false,
                    'href'    => 'admin/addons/field_types?view=' . $view,
                ],
            ]
        );
    }
}
