<?php namespace Anomaly\AddonsModule\Addon\Table\View;

use Anomaly\AddonsModule\Addon\Table\AddonTableBuilder;
use Anomaly\AddonsModule\Addon\Table\Command\FetchPackages;
use Anomaly\AddonsModule\Addon\Table\Command\GetPackageData;
use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class PackageViewHandler
 */
class PackageViewHandler
{

    use DispatchesJobs;

    /**
     * Handle the command
     *
     * @param AddonTableBuilder $builder The builder
     */
    public function handle(AddonTableBuilder $builder, AddonCollection $addons)
    {
        $entries  = new AddonCollection([]);
        $packages = $this->dispatch(new FetchPackages());

        foreach ($packages as $package)
        {
            $data = $this->dispatch(new GetPackageData($package));

            if (!$addons->get(array_get($data, 'namespace'), false))
            {
                $addon = (new Addon())
                ->setVendor(array_get($data, 'vendor'))
                ->setType('package')
                ->setSlug(array_get($data, 'slug'));

                $addon->package = $package;

                $entries->put($addon->getNamespace(), $addon);
                $addons->put($addon->getNamespace(), $addon);
            }
        }

        $builder->setTableEntries($entries);
    }
}
