<?php
namespace Weekend;

use GuzzleHttp\Client;

class Api
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $entryPoint;

    /**
     * Api constructor.
     * @param Client|null $client
     * @param null $entryPoint
     */
    public function __construct(Client $client = null, $entryPoint = null)
    {
        $this->client = $client ?: new Client();
        $this->entryPoint = $entryPoint ?: 'http://estcequecestbientotleweekend.fr/api';
    }

    public function fetch()
    {
        $ressource = $this->client->request('GET', $this->entryPoint);

        $data = $ressource->getBody();
        return trim(json_decode($data, JSON_OBJECT_AS_ARRAY)['text']);

    }
}
