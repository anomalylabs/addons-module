<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Addon\Contract\AddonRepositoryInterface;
use Anomaly\AddonsModule\Http\Middleware\MonitorComposerLog;
use Anomaly\AddonsModule\Repository\Form\RepositoryFormBuilder;
use Anomaly\AddonsModule\Repository\RepositoryManager;
use Anomaly\AddonsModule\Repository\Table\RepositoryTableBuilder;
use Anomaly\Streams\Platform\Asset\Asset;
use Anomaly\Streams\Platform\Console\Kernel;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class RepositoriesController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RepositoriesController extends AdminController
{

    /**
     * Create a new RepositoriesController instance.
     *
     * @param Asset $asset
     */
    public function __construct(Asset $asset, RepositoryManager $manager)
    {
        parent::__construct();

        $this->middleware(MonitorComposerLog::class);

        $asset->add('scripts.js', 'anomaly.module.addons::js/addons.js');
    }

    /**
     * Display an index of existing entries.
     *
     * @param RepositoryTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(RepositoryTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param RepositoryFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(RepositoryFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param RepositoryFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(RepositoryFormBuilder $form, $id)
    {
        return $form->render($id);
    }

    /**
     * Sync all repositories.
     *
     * @param Kernel $console
     * @param AddonRepositoryInterface $addons
     */
    public function sync(Kernel $console, AddonRepositoryInterface $addons)
    {
        $addons->flushCache();

        $console->call('addons:sync');
    }
}
