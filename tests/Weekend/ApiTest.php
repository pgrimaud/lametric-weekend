<?php

namespace Weekend;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

class ApiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    private $client;

    public function setUp()
    {
        $fixtures = file_get_contents(__DIR__ . '/../fixtures/apiresponse.json');

        $response = new \GuzzleHttp\Psr7\Response(200, [], $fixtures);
        $mock = new MockHandler([$response]);

        $handler = HandlerStack::create($mock);
        $this->client = new Client(['handler' => $handler]);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testValidRessourceFromApi()
    {
        $api = new Api($this->client);
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
        $mock = new MockHandler([$response]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $api = new Api($client);
        $ressource = $api->fetch();
        $this->assertSame('Presque, mais pas encore. :(', $ressource);
    }
}

