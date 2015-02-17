<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Distribution\Table\DistributionTableBuilder;
use Anomaly\Streams\Platform\Addon\Distribution\DistributionCollection;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class DistributionsController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Distribution\Addons\Http\Controllers\Admin
 */
class DistributionsController extends AdminController
{

    /**
     * Return an index of existing distributions.
     *
     * @param DistributionTableBuilder $table
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function index(DistributionTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Output the readme for a distribution.
     *
     * @param                        $distribution
     * @param DistributionCollection $distributions
     * @return \Illuminate\View\View
     */
    public function readme($distribution, DistributionCollection $distributions)
    {
        $addon = $distributions->get($distribution);

        $readme = $addon->getPath('README.md');

        if (file_exists($readme)) {
            $readme = file_get_contents($readme);
        }

        return view('module::admin/modals/readme', compact('addon', 'readme'));
    }
}
