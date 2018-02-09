<?php namespace Anomaly\AddonsModule\Addon\Table\Command;

use GuzzleHttp\Client;

/**
 * Class FetchComposerJson
 */
class FetchComposerJson
{

    /**
     * Package datas
     *
     * array
     */
    protected $package;

    /**
     * Create new FetchComposerJson instance
     *
     * @param array $package The package
     */
    public function __construct(array $package)
    {
        $this->package = $package;
    }

    /**
     * Handle the command
     */
    public function handle()
    {
        $name = array_get($this->package, 'name');

        $client = new Client([
            'base_uri' => 'https://api.github.com',
            'timeout'  => 0,
        ]);

        $response = $client->get('/repos/anomalylabs/'.$name.'/contents/composer.json');

        $gitFile = json_decode($response->getBody()->getContents(), true);

        dd($gitFile);

        return json_decode($response->getBody()->getContents(), true);
    }
}
