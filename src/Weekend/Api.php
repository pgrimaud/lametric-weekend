<?php

declare(strict_types=1);

namespace Weekend;

use GuzzleHttp\Client;
use Predis\Client as PredisClient;

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
     * @var PredisClient
     */
    private PredisClient $predisClient;

    /**
     * @param Client|null $client
     * @param string $entryPoint
     * @param PredisClient|null $predisClient
     */
    public function __construct(Client $client = null, PredisClient $predisClient = null, string $entryPoint = '')
    {
        $this->client       = $client ?: new Client;
        $this->entryPoint   = $entryPoint ?: 'https://estcequecestbientotleweekend.fr/api';
        $this->predisClient = $predisClient ?: new PredisClient;
    }

    /**
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fetch(): string
    {
        $redisKey = 'lametric:weekend';

        $sentence = $this->predisClient->get($redisKey);
        $ttl      = $this->predisClient->ttl($redisKey);

        if (!$sentence || $ttl < 0) {
            $resource = $this->client->request('GET', $this->entryPoint, [
                'verify' => false,
            ]);
            $sentence = (string)$resource->getBody();

            $this->predisClient->set($redisKey, $sentence);
            $this->predisClient->expire($redisKey, 5 * 60);
        }

        return trim(json_decode((string)$sentence, true)['text']);
    }
}
