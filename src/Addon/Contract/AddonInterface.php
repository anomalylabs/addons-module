<?php namespace Anomaly\AddonsModule\Addon\Contract;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Interface AddonInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface AddonInterface extends EntryInterface
{

    /**
     * Return the PRO flag.
     *
     * @return bool
     */
    public function isPro();

    /**
     * Get the addon name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the addon type.
     *
     * @return string
     */
    public function getType();

    /**
     * Return the display name.
     *
     * @return string
     */
    public function displayName();

    /**
     * Return the updates flag.
     *
     * @return bool
     */
    public function hasUpdates();

    /**
     * Return the downloaded flag.
     *
     * @return bool
     */
    public function isDownloaded();

    /**
     * Get the versions.
     *
     * @return array
     */
    public function getVersions();

    /**
     * Return the latest version.
     *
     * @return string
     */
    public function latestVersion();

    /**
     * Get the licenses.
     *
     * @return array
     */
    public function getLicenses();

    /**
     * Get the namespace.
     *
     * @return string
     */
    public function getNamespace();

    /**
     * Return the addon instance.
     *
     * @return Addon
     */
    public function instance();

}
