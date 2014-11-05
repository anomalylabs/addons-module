<?php namespace Anomaly\Streams\Addon\Module\Addons\Ui\Table;

use Anomaly\Streams\Platform\Ui\Table\Contract\TableRepositoryInterface;

class ModuleTableRepository implements TableRepositoryInterface
{

    /**
     * Get entry interfaces.
     *
     * @return mixed
     */
    public function get()
    {
        return app('streams.modules')->all();
    }
}
 