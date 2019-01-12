<?php namespace Anomaly\AddonsModule\Repository;

use Anomaly\AddonsModule\Repository\Contract\RepositoryInterface;
use Anomaly\Streams\Platform\Model\Addons\AddonsRepositoriesEntryModel;

/**
 * Class RepositoryModel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RepositoryModel extends AddonsRepositoriesEntryModel implements RepositoryInterface
{

    /**
     * Get the URL.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

}
