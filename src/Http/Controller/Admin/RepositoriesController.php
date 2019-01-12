<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Repository\Form\RepositoryFormBuilder;
use Anomaly\AddonsModule\Repository\Table\RepositoryTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class RepositoriesController extends AdminController
{

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
}
