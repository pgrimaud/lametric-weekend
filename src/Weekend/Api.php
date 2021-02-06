<?php

declare(strict_types=1);

namespace Weekend;

use GuzzleHttp\Client;

class Api
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var string
     */
    private string $entryPoint;

    /**
     * Api constructor.
     * @param Client|null $client
     * @param string $entryPoint
     */
    public function __construct(Client $client = null, string $entryPoint = '')
    {
        $this->client     = $client ?: new Client();
        $this->entryPoint = $entryPoint ?: 'https://estcequecestbientotleweekend.fr/api';
    }

    /**
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fetch(): string
    {
        $resource = $this->client->request('GET', $this->entryPoint, [
            'verify' => false,
        ]);

        $data = $resource->getBody();
        return trim(json_decode($data, JSON_OBJECT_AS_ARRAY)['text']);
    }
}
