<?php namespace Anomaly\AddonsModule\Addon\Contract;

use Anomaly\AddonsModule\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Image\Image;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

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
     * Get the addon title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Get the addon type.
     *
     * @return string
     */
    public function getType();

    /**
     * Get the readme.
     *
     * @return string|null
     */
    public function getReadme();

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
     * Get the authors.
     *
     * @return array
     */
    public function getAuthors();

    /**
     * Get the support.
     *
     * @return array
     */
    public function getSupport();

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
     * Get the required packages.
     *
     * @return array
     */
    public function getRequires();

    /**
     * Get the namespace.
     *
     * @return string
     */
    public function getNamespace();

    /**
     * Get the assets.
     *
     * @return array
     */
    public function getAssets();

    /**
     * Get the marketplace information.
     *
     * @return array
     */
    public function getMarketplace();

    /**
     * Get an asset.
     *
     * @param null $key
     * @param null $default
     * @return mixed
     */
    public function asset($key = null, $default = null);

    /**
     * Check if an asset exists.
     *
     * @param $key
     * @return mixed
     */
    public function hasAsset($key);

    /**
     * Return the icon image.
     *
     * @return null|Image
     */
    public function icon();

    /**
     * Return the banner image.
     *
     * @return null|Image
     */
    public function banner();

    /**
     * Return the screenshot images.
     *
     * @return array
     */
    public function screenshots();

    /**
     * Return the addon instance.
     *
     * @return Addon
     */
    public function instance();

    /**
     * Get the related dependents.
     *
     * @return AddonCollection|Collection
     */
    public function getDependents();

    /**
     * Return the dependents relationship.
     *
     * @return Builder
     */
    public function dependents();

}
