<?php namespace Anomaly\AddonsModule\Addon\Command;

use Composer\Semver\Comparator;
use Composer\Semver\Semver;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class GetOutdatedStatus
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetOutdatedStatus
{

    use DispatchesJobs;

    /**
     * The addon information.
     *
     * @var array
     */
    protected $addon;

    /**
     * Create a new GetOutdatedStatus instance.
     *
     * @param array $addon
     */
    public function __construct(array $addon)
    {
        $this->addon = $addon;
    }

    /**
     * Handle the command.
     *
     * @return bool
     */
    public function handle()
    {

        if (!$constraint = array_get($this->addon, 'constraint')) {
            return false;
        }

        if (!$installed = array_get($this->addon, 'lock.version')) {
            return false;
        }

        $satisfied = Semver::satisfiedBy(
            $this->addon['versions'],
            $constraint
        );

        $installed = ltrim($installed, 'v');

        foreach ($satisfied as $version) {

            $version = ltrim($version, 'v');

            if (str_contains($version, ['stable', 'RC', 'beta', 'alpha', 'dev'])) {
                continue;
            }

            if (Comparator::equalTo($version, $installed)) {
                continue;
            }

            if (Comparator::greaterThan($version, $installed)) {
                return true;
            }
        }

        return false;
    }

}
