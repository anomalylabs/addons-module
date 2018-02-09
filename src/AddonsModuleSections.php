<?php namespace Anomaly\AddonsModule;

use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;
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

        $builder->setSections(
            [
                'modules'     => [
                    'matcher' => 'admin/addons/modules*',
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
