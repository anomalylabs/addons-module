<?php namespace Anomaly\AddonsModule\Addon\Table\Command;

use Anomaly\AddonsModule\Addon\AddonNormalizer;
use Anomaly\AddonsModule\Addon\Table\AddonTableBuilder;

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
     * The addon table builder.
     *
     * @var AddonTableBuilder
     */
    protected $builder;

    /**
     * Create a new GetDownloadedAddons instance.
     *
     * @param AddonTableBuilder $builder
     */
    public function __construct(AddonTableBuilder $builder)
    {
        $this->builder = $builder;
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
                    return $package['type'] == 'streams-addon'
                        && str_is('*/*-' . str_singular($this->builder->getType()), $package['name']);
                }
            )
        );
    }
}
