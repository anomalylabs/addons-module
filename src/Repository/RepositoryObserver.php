<?php namespace Anomaly\AddonsModule\Repository;

use Anomaly\AddonsModule\Repository\Command\CacheRepository;
use Anomaly\AddonsModule\Repository\Command\UnlinkRepository;
use Anomaly\AddonsModule\Repository\Contract\RepositoryInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;
use Anomaly\Streams\Platform\Message\MessageBag;

/**
 * Class RepositoryObserver
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RepositoryObserver extends EntryObserver
{

    /**
     * Fired just after creating the entry.
     *
     * @param EntryInterface|RepositoryInterface $entry
     */
    public function created(EntryInterface $entry)
    {
        try {
            dispatch_now(new CacheRepository($entry));
        } catch (\Exception $exception) {

            // We could be offline or bad URL or something.
            app(MessageBag::class)->error($exception->getMessage());
        }

        parent::created($entry);
    }

    /**
     * Fired just after deleting the entry.
     *
     * @param EntryInterface|RepositoryInterface $entry
     */
    public function deleted(EntryInterface $entry)
    {
        dispatch_now(new UnlinkRepository($entry));

        parent::deleted($entry);
    }

}
