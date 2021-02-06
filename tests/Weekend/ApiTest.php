<?php

namespace Weekend;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use M6Web\Component\RedisMock\RedisMockFactory;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    /**
     * @var \Predis\Client
     */
    private \Predis\Client $redisMockClass;

    /**
     * @var Client
     */
    private Client $client;

    public function setUp(): void
    {
        $fixtures = file_get_contents(__DIR__ . '/../fixtures/apiresponse.json');

        $response = new \GuzzleHttp\Psr7\Response(200, [], $fixtures);
        $mock     = new MockHandler([$response]);

        $handler      = HandlerStack::create($mock);
        $this->client = new Client(['handler' => $handler]);

        $factory              = new RedisMockFactory;
        $redisMockClass       = $factory->getAdapterClass('Predis\\Client');
        $this->redisMockClass = new $redisMockClass;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testValidRessourceFromApi()
    {
        $api       = new Api($this->client, $this->redisMockClass);
        $ressource = $api->fetch();
        $this->assertSame('Presque, mais pas encore. :(', $ressource);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testInvalidRessourceFromApi()
    {
        $this->expectException(ClientException::class);

        $response = new \GuzzleHttp\Psr7\Response(404, []);
        $mock     = new MockHandler([$response]);

        $handler = HandlerStack::create($mock);
        $client  = new Client(['handler' => $handler]);

        $api       = new Api($client, $this->redisMockClass);
        $ressource = $api->fetch();
        $this->assertSame('Presque, mais pas encore. :(', $ressource);
    }
}
