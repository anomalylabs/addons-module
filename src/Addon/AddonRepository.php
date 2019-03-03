<?php namespace Anomaly\AddonsModule\Addon;

use Anomaly\AddonsModule\Addon\Contract\AddonInterface;
use Anomaly\AddonsModule\Addon\Contract\AddonRepositoryInterface;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Entry\EntryRepository;

/**
 * Class AddonRepository
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonRepository extends EntryRepository implements AddonRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var AddonModel
     */
    protected $model;

    /**
     * Create a new AddonRepository instance.
     *
     * @param AddonModel $model
     */
    public function __construct(AddonModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find an addon by it's name.
     *
     * @param $name
     * @return AddonInterface|null
     */
    public function findByName($name)
    {
        return $this->model->where('name', $name)->first();
    }

    /**
     * Find an addon by it's namespace.
     *
     * @param $namespace
     * @return AddonInterface|null
     */
    public function findByNamespace($namespace)
    {
        return $this->model->where('namespace', $namespace)->first();
    }

    /**
     * Find an addon by it's name or namespace.
     *
     * @param $identifier
     * @return AddonInterface|null
     */
    public function findByNameOrNamespace($identifier)
    {
        return $this->model
            ->where('name', $identifier)
            ->orWhere('namespace', $identifier)
            ->first();
    }

    /**
     * Return all downloaded addons.
     *
     * @return AddonCollection
     */
    public function downloaded()
    {
        return $this->model->whereIn('namespace', app(AddonCollection::class)->pluck('namespace')->all())->get();
    }

    /**
     * Return all addons except
     * with the provided names.
     *
     * @param array $names
     * @return AddonCollection
     */
    public function except(array $names)
    {
        return $this->model->whereNotIn('name', $names)->get();
    }

}
