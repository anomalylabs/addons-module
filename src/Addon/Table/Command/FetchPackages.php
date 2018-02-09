<?php namespace Anomaly\AddonsModule\Addon\Table\Command;

use GuzzleHttp\Client;

/**
 * Class FetchPackages
 */
class FetchPackages
{

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
