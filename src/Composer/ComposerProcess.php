<?php namespace Anomaly\AddonsModule\Composer;

use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\Process;

/**
 * Class ComposerProcess
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ComposerProcess
{

    /**
     * Make a new composer process.
     *
     * @param $command
     * @param $addon
     * @return Process
     */
    public static function make($command, $addon)
    {
        $command = env('PHP_PATH', (new PhpExecutableFinder())->find()) . " ./bin/composer {$command} {$addon}";

        \Log::info('[composer]: ');

        return new Process(
            $command,
            base_path(),
            $_ENV + ['COMPOSER_HOME' => base_path('bin')],
            null,
            60 * 5
        );
    }
}
