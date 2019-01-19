<?php namespace Anomaly\AddonsModule\Http\Controller\Admin;

use Anomaly\AddonsModule\Addon\Contract\AddonInterface;
use Anomaly\AddonsModule\Addon\Contract\AddonRepositoryInterface;
use Anomaly\AddonsModule\Composer\ComposerAuthorizer;
use Anomaly\Streams\Platform\Addon\AddonManager;
use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Console\Kernel;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Log\Writer;

/**
 * Class ComposerController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ComposerController extends AdminController
{

    /**
     * Download an addon.
     *
     * @param AddonRepositoryInterface $addons
     * @param ComposerAuthorizer $authorizer
     * @param Kernel $console
     * @param $addon
     * @throws \Exception
     */
    public function download(
        AddonRepositoryInterface $addons,
        ComposerAuthorizer $authorizer,
        Kernel $console,
        $addon
    ) {
        /* @var AddonInterface $addon */
        $addon = $addons->findByNamespace($addon);

        if (!$authorizer->authorize(__FUNCTION__, $addon->getType())) {
            throw new \Exception('[' . __FUNCTION__ . '] command is not permitted.');
        }

        $console->call('addon:download', ['addon' => $addon->getName()]);
    }

    /**
     * Update an addon.
     *
     * @param AddonRepositoryInterface $addons
     * @param ComposerAuthorizer $authorizer
     * @param Kernel $console
     * @param $addon
     * @throws \Exception
     */
    public function update(
        AddonRepositoryInterface $addons,
        ComposerAuthorizer $authorizer,
        Kernel $console,
        $addon
    ) {
        /* @var AddonInterface $addon */
        $addon = $addons->findByNamespace($addon);

        if (!$authorizer->authorize(__FUNCTION__, $addon->getType())) {
            throw new \Exception('[' . __FUNCTION__ . '] command is not permitted.');
        }

        $console->call('addon:update', ['addon' => $addon->getName()]);
    }

    /**
     * Remove an addon.
     *
     * @param AddonRepositoryInterface $addons
     * @param ComposerAuthorizer $authorizer
     * @param Kernel $console
     * @param $addon
     * @throws \Exception
     */
    public function remove(
        AddonRepositoryInterface $addons,
        ComposerAuthorizer $authorizer,
        Kernel $console,
        $addon
    ) {
        /* @var AddonInterface $addon */
        $addon = $addons->findByNamespace($addon);

        if (!$authorizer->authorize(__FUNCTION__, $addon->getType())) {
            throw new \Exception('[' . __FUNCTION__ . '] command is not permitted.');
        }

        $console->call('addon:remove', ['addon' => $addon->getName()]);
    }

}
