<?php namespace Anomaly\AddonsModule\Addon;

use Anomaly\AddonsModule\Addon\Contract\AddonInterface;
use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\Command\GetAddon;
use Anomaly\Streams\Platform\Model\Addons\AddonsAddonsEntryModel;

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
     * Get the addon type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Return the display name.
     *
     * @return string
     */
    public function displayName()
    {
        return $this->getTitle() . ' ' . ucwords(str_replace('_', ' ', $this->getType()));
    }

    /**
     * Return the updates flag.
     *
     * @return bool|null
     */
    public function hasUpdates()
    {
        /* @var Addon $addon */
        if (!$addon = dispatch_now(new GetAddon($this->getNamespace()))) {
            return null;
        }

        return $addon->getComposerLock()['version'] == $this->latestVersion();
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
     * Get the namespace.
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
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
        return json_decode($this->attributes['requires'], true);
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

}
