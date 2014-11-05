<?php namespace Anomaly\Streams\Addon\Module\Addons\Ui\Table\View;

use Anomaly\Streams\Platform\Ui\Table\Contract\TableViewInterface;

class InstalledModulesView implements TableViewInterface
{

    /**
     * Handle the table view.
     *
     * @param $query
     * @return mixed
     */
    public function handle($query)
    {
        return $query->installed();
    }
}
 