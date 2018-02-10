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
     * The repository details.
     *
     * @var array
     */
    protected $details;

    /**
     * Create a new GetOutdatedStatus instance.
     *
     * @param array $details
     */
    public function __construct(array $details)
    {
        $this->details = $details;
    }

    public function handle()
    {
        $composer = json_decode(file_get_contents(base_path('composer.json')), true);

        if (!$constraint = array_get($composer['require'], $this->details['name'])) {
            return false;
        }

        $installed = $this->details['version'];

        $satisfied = Semver::satisfiedBy(
            $this->details['versions'],
            $constraint
        );

        foreach ($satisfied as $available) {

            if (Comparator::equalTo($installed, $available)) {
                continue;
            }

            if (Comparator::greaterThan($available, $installed)) {
                dd($available.', '.$installed);
                return true;
            }
        }

        return false;
    }

}
