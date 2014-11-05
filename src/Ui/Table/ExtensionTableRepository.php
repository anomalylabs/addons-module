<?php namespace Anomaly\Streams\Addon\Module\Addons\Ui\Table;

use Anomaly\Streams\Platform\Ui\Table\Contract\TableRepositoryInterface;

class ExtensionTableRepository implements TableRepositoryInterface
{

    /**
     * Get entry interfaces.
     *
     * @return mixed
     */
    public function get()
    {
        return app('streams.extensions')->all();
    }
}
 