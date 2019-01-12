<?php namespace Anomaly\AddonsModule\Repository;

use Anomaly\AddonsModule\Repository\Contract\RepositoryRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class RepositoryRepository extends EntryRepository implements RepositoryRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var RepositoryModel
     */
    protected $model;

    /**
     * Create a new RepositoryRepository instance.
     *
     * @param RepositoryModel $model
     */
    public function __construct(RepositoryModel $model)
    {
        $this->model = $model;
    }
}
