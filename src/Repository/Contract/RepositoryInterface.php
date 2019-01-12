<?php namespace Anomaly\AddonsModule\Repository\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Interface RepositoryInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface RepositoryInterface extends EntryInterface
{

    /**
     * Get the URL.
     *
     * @return string
     */
    public function getUrl();

}
