<?php namespace Anomaly\AddonsModule\Addon\Table\Command;

use Anomaly\Streams\Platform\Addon\Addon;
use GuzzleHttp\Client;

/**
 * Class FetchAddons
 */
class FetchAddons
{

    /**
     * Already loaded addons
     *
     * @var AddonCollection
     */
    protected $addons;

    /**
     * Create the FetchAddons instance
     *
     * @param Collection $addons The loaded addons
     */
    public function __construct($addons)
    {
        $this->addons = $addons;
    }

    /**
     * Handle the command
     */
    public function handle()
    {
        $client = new Client([
            'base_uri' => 'https://api.github.com',
            'timeout'  => 0,
        ]);

        $response = $client->get('/users/anomalylabs/repos');

        return json_decode($response->getBody()->getContents(), true);
    }
}
