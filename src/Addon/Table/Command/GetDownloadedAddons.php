<?php namespace Anomaly\AddonsModule\Addon\Table\Command;

use Anomaly\AddonsModule\Addon\AddonNormalizer;

/**
 * Class GetDownloadedAddons
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetDownloadedAddons
{

    /**
     * The type of addons to return.
     *
     * @var string
     */
    protected $type;

    /**
     * Create a new GetDownloadedAddons instance.
     *
     * @param null $type
     */
    public function __construct($type = null)
    {
        $this->type = $type;
    }


    /**
     * Handle the command.
     *
     * @param AddonNormalizer $normalizer
     * @return array
     */
    public function handle(AddonNormalizer $normalizer)
    {
        return $normalizer->normalize(
            array_filter(
                json_decode(file_get_contents(base_path('composer.lock')), true)['packages'],
                function ($package) {

                    if (array_get($package, 'type') != 'streams-addon') {
                        return false;
                    }

                    if (!$this->type) {
                        return true;
                    }

                    return str_is('*/*-' . str_singular($this->type), $package['name']);
                }
            )
        );
    }
}
