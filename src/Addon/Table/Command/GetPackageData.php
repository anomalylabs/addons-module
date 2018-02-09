<?php namespace Anomaly\AddonsModule\Addon\Table\Command;

/**
 * Class GetPackageData
 */
class GetPackageData
{

    /**
     * Github loaded repo
     *
     * @var array
     */
    protected $repo;

    /**
     * Create the GetPackageData instance
     *
     * @param array $repo The loaded repo
     */
    public function __construct(array $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Handle the command
     */
    public function handle()
    {
        $fullName = array_get($this->repo, 'full_name');

        $firstSplit  = explode('/', $fullName);
        $secondSplit = explode('-', array_get($firstSplit, 1));

        $vendor = str_replace('anomalylabs', 'anomaly', array_get($firstSplit, 0));
        $type   = array_get($secondSplit, 1);
        $slug   = array_get($secondSplit, 0);

        return [
            'vendor'    => $vendor,
            'type'      => $type,
            'slug'      => $slug,
            'namespace' => "$vendor.$type.$slug",
        ];
    }
}
