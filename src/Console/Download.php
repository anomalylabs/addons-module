<?php namespace Anomaly\AddonsModule\Console;

use Anomaly\AddonsModule\Repository\Command\DownloadRepository;
use Anomaly\AddonsModule\Repository\Contract\RepositoryInterface;
use Anomaly\AddonsModule\Repository\Contract\RepositoryRepositoryInterface;
use Illuminate\Console\Command;

/**
 * Class Download
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Download extends Command
{

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'addons:download';

    /**
     * Handle the command.
     *
     * @param RepositoryRepositoryInterface $repositories
     */
    public function handle(RepositoryRepositoryInterface $repositories)
    {
        /* @var RepositoryInterface $repository */
        foreach ($repositories->all() as $repository) {

            $this->info('Downloading: ' . $repository->getUrl());

            dispatch_now(new DownloadRepository($repository));
        }
    }

}
