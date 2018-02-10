<?php namespace Anomaly\AddonsModule\Composer\Command;

use Anomaly\AddonsModule\Composer\ComposerAuthorizer;

class GetComposerAuthorization
{

    /**
     * The target type.
     *
     * @var string
     */
    protected $type;

    /**
     * The target command.
     *
     * @var string
     */
    protected $command;

    /**
     * Create a new GetComposerAuthorization instance.
     *
     * @param string $command
     * @param string $type
     */
    public function __construct($command, $type)
    {
        $this->type    = $type;
        $this->command = $command;
    }

    /**
     * Handle the command.
     *
     * @param ComposerAuthorizer $authorizer
     * @return bool
     */
    public function handle(ComposerAuthorizer $authorizer)
    {
        return $authorizer->authorize($this->command, $this->type);
    }
}
