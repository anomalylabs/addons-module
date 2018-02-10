<?php namespace Anomaly\AddonsModule\Composer;

use Anomaly\Streams\Platform\Support\Authorizer;
use Illuminate\Contracts\Config\Repository;

/**
 * Class ComposerAuthorizer
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ComposerAuthorizer
{

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * The authorizer service.
     *
     * @var Authorizer
     */
    protected $authorizer;

    /**
     * Create a new ComposerAuthorizer instance.
     *
     * @param Repository $config
     * @param Authorizer $authorizer
     */
    public function __construct(Repository $config, Authorizer $authorizer)
    {
        $this->config     = $config;
        $this->authorizer = $authorizer;
    }

    /**
     * Authorize the command and target type.
     *
     * @param $command
     * @param $type
     * @return bool
     */
    public function authorize($command, $type)
    {
        if (!$this->authorizer->authorize("anomaly.module.addons::{$type}.{$command}")) {
            return false;
        }

        if (env('APP_ENV') !== 'production' || $this->config->get("anomaly.module.addons::composer.allow_{$command}")) {
            return true;
        }

        return false;
    }
}
