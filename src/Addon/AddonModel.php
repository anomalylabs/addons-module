<?php namespace Anomaly\AddonsModule\Addon;

use Anomaly\AddonsModule\Addon\Contract\AddonInterface;
use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\Command\GetAddon;
use Anomaly\Streams\Platform\Image\Image;
use Anomaly\Streams\Platform\Model\Addons\AddonsAddonsEntryModel;
use Composer\Semver\Comparator;
use Composer\Semver\Semver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * Class AddonModel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonModel extends AddonsAddonsEntryModel implements AddonInterface
{

    /**
     * Return the PRO flag.
     *
     * @return bool
     */
    public function isPro()
    {
        return in_array('https://pyrocms.com/pro/license', $this->getLicenses());
    }

    /**
     * Get the addon name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the addon title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the addon type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the addon readme.
     *
     * @return string
     */
    public function getReadme()
    {
        return $this->readme;
    }

    /**
     * Return the display name.
     *
     * @return string
     */
    public function displayName()
    {
        return preg_replace("/.title$/", '.name', $this->getTitle());
    }

    /**
     * Return the updates flag.
     *
     * @return bool
     */
    public function hasUpdates()
    {
        /* @var Addon $addon */
        if (!$addon = dispatch_now(new GetAddon($this->getNamespace()))) {
            return false;
        }

        $composer = app('composer.json');

        if (!$constraint = array_get($composer['require'], $this->getName())) {
            return false;
        }

        if (!$installed = array_get($addon->getComposerLock(), 'version')) {
            return false;
        }

        $satisfied = Semver::satisfiedBy(
            $this->getVersions(),
            $constraint
        );

        $satisfied = array_filter(
            $satisfied,
            function ($version) use ($installed) {

                if (Comparator::equalTo($version, $installed)) {
                    return null;
                }

                return Comparator::greaterThan($version, $installed) ? $version : null;
            }
        );

        return !empty($satisfied);
    }

    /**
     * Return the downloaded flag.
     *
     * @return bool
     */
    public function isDownloaded()
    {
        return (dispatch_now(new GetAddon($this->getNamespace())));
    }

    /**
     * Return if the addon
     * is installable or not.
     *
     * @return bool
     */
    public function isInstallable()
    {
        return in_array($this->getType(), ['module', 'extension']);
    }

    /**
     * Return the latest version.
     *
     * @return string
     */
    public function latestVersion()
    {
        $versions = $this->getVersions();

        return array_pop($versions);
    }

    /**
     * Get the authors.
     *
     * @return array
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Get the support.
     *
     * @return array
     */
    public function getSupport()
    {
        return $this->support;
    }

    /**
     * Get the versions.
     *
     * @return array
     */
    public function getVersions()
    {
        return $this->versions;
    }

    /**
     * Get the licenses.
     *
     * @return array
     */
    public function getLicenses()
    {
        return $this->licenses;
    }

    /**
     * Get the required packages.
     *
     * @return array
     */
    public function getRequires()
    {
        return $this->requires;
    }

    /**
     * Get the suggested packages.
     *
     * @return array
     */
    public function getSuggests()
    {
        return $this->suggests;
    }

    /**
     * Get the namespace.
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Get the assets.
     *
     * @return array
     */
    public function getAssets()
    {
        return $this->assets;
    }

    /**
     * Get the marketplace information.
     *
     * @return array
     */
    public function getMarketplace()
    {
        return $this->assets;
    }

    /**
     * Get an asset.
     *
     * @param null $key
     * @param null $default
     * @return mixed
     */
    public function asset($key = null, $default = null)
    {
        $assets = $this->getAssets();

        if ($key) {
            return array_get($assets, $key, $default);
        }

        return $assets;
    }

    /**
     * Get a marketplace value.
     *
     * @param null $key
     * @param null $default
     * @return mixed
     */
    public function marketplace($key = null, $default = null)
    {
        $marketplace = $this->getMarketplace();

        if ($key) {
            return array_get($marketplace, $key, $default);
        }

        return $marketplace;
    }

    /**
     * Check if an asset exists.
     *
     * @param $key
     * @return mixed
     */
    public function hasAsset($key)
    {
        $assets = $this->getAssets();

        return (array_get($assets, $key));
    }

    /**
     * Return the icon image.
     *
     * @return null|Image
     */
    public function icon()
    {
        if (!$asset = $this->asset('icon')) {
            return app(Image::class)->make('anomaly.module.addons::img/icon.jpg');
        }

        $extension = pathinfo($asset, PATHINFO_EXTENSION);

        return app(Image::class)->make(
            'https://assets.pyrocms.com/marketplace/'
            . str_replace(['/', '_'], '-', $this->getName())
            . '-icon.' . $extension
        );
    }

    /**
     * Return the banner image.
     *
     * @return null|Image
     */
    public function banner()
    {
        if (!$asset = $this->asset('banner')) {
            return app(Image::class)->make('anomaly.module.addons::img/banner.jpg');
        }

        $extension = pathinfo($asset, PATHINFO_EXTENSION);

        return app(Image::class)->make(
            'https://assets.pyrocms.com/marketplace/'
            . str_replace(['/', '_'], '-', $this->getName())
            . '-banner.' . $extension
        );
    }

    /**
     * Return the screenshot images.
     *
     * @return array
     */
    public function screenshots()
    {
        $screenshots = $this->asset('screenshots', []);

        foreach ($screenshots as $index => &$screenshot) {

            $extension = pathinfo($screenshot, PATHINFO_EXTENSION);

            $screenshot = app(Image::class)->make(
                'https://assets.pyrocms.com/marketplace/'
                . str_replace(['/', '_'], '-', $this->getName())
                . '-screenshot-' . ($index + 1) . '.' . $extension
            );
        }

        return $screenshots;
    }

    /**
     * Return the addon instance.
     *
     * @return Addon
     */
    public function instance()
    {
        return dispatch_now(new GetAddon($this->getNamespace()));
    }

    /**
     * Set the requires attribute.
     *
     * @param $value
     * @return $this
     */
    public function setRequiresAttribute($value)
    {
        $this->attributes['requires'] = serialize($value);

        return $this;
    }

    /**
     * Get the requires attribute.
     *
     * @param $value
     * @return $this
     */
    public function getRequiresAttribute()
    {
        return unserialize($this->attributes['requires']);
    }

    /**
     * Set the suggests attribute.
     *
     * @param $value
     * @return $this
     */
    public function setSuggestsAttribute($value)
    {
        $this->attributes['suggests'] = serialize($value);

        return $this;
    }

    /**
     * Get the suggests attribute.
     *
     * @param $value
     * @return $this
     */
    public function getSuggestsAttribute()
    {
        return unserialize($this->attributes['suggests']);
    }

    /**
     * Set the versions attribute.
     *
     * @param $value
     * @return $this
     */
    public function setVersionsAttribute($value)
    {
        $this->attributes['versions'] = serialize($value);

        return $this;
    }

    /**
     * Get the versions attribute.
     *
     * @param $value
     * @return array
     */
    public function getVersionsAttribute()
    {
        return (array)unserialize($this->attributes['versions']);
    }

    /**
     * Set the licenses attribute.
     *
     * @param $value
     * @return $this
     */
    public function setLicensesAttribute($value)
    {
        $this->attributes['licenses'] = serialize($value);

        return $this;
    }

    /**
     * Get the licenses attribute.
     *
     * @param $value
     * @return array
     */
    public function getLicensesAttribute()
    {
        return unserialize($this->attributes['licenses']);
    }

    /**
     * Set the authors attribute.
     *
     * @param $value
     * @return $this
     */
    public function setAuthorsAttribute($value)
    {
        $this->attributes['authors'] = serialize($value);

        return $this;
    }

    /**
     * Get the authors attribute.
     *
     * @param $value
     * @return array
     */
    public function getAuthorsAttribute()
    {
        return (array)unserialize($this->attributes['authors']);
    }

    /**
     * Set the support attribute.
     *
     * @param $value
     * @return $this
     */
    public function setSupportAttribute($value)
    {
        $this->attributes['support'] = serialize($value);

        return $this;
    }

    /**
     * Get the support attribute.
     *
     * @param $value
     * @return array
     */
    public function getSupportAttribute()
    {
        return (array)unserialize($this->attributes['support']);
    }

    /**
     * Set the assets attribute.
     *
     * @param $value
     * @return $this
     */
    public function setAssetsAttribute($value)
    {
        $this->attributes['assets'] = serialize($value);

        return $this;
    }

    /**
     * Get the assets attribute.
     *
     * @param $value
     * @return array
     */
    public function getAssetsAttribute()
    {
        return (array)unserialize($this->attributes['assets']);
    }

    /**
     * Set the marketplace attribute.
     *
     * @param $value
     * @return $this
     */
    public function setMarketplaceAttribute($value)
    {
        $this->attributes['marketplace'] = serialize($value);

        return $this;
    }

    /**
     * Get the marketplace attribute.
     *
     * @param $value
     * @return array
     */
    public function getMarketplaceAttribute()
    {
        return (array)unserialize($this->attributes['marketplace']);
    }

    /**
     * Get the related dependents.
     *
     * @return AddonCollection|Collection
     */
    public function getDependents()
    {
        return $this
            ->dependents()
            ->get();
    }

    /**
     * Return the dependents relationship.
     *
     * @return Builder
     */
    public function dependents()
    {
        return $this
            ->newQuery()
            ->where('requires', 'LIKE', '%"' . $this->getName() . '"%');
    }

}
