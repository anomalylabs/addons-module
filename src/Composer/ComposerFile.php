<?php namespace Anomaly\AddonsModule\Composer;

/**
 * Class ComposerFile
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ComposerFile
{

    /**
     * Remove an addon from composer.json
     *
     * @param $addon
     */
    public static function remove($addon)
    {
        $json = json_decode(file_get_contents(base_path('composer.json')), true);

        if (isset($json['require'][$addon])) {
            unset($json['require'][$addon]);
        }

        file_put_contents(
            base_path('composer.json'),
            json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );
    }
}
