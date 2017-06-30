<?php
namespace Weekend;

class ResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testAsJsonResponse()
    {
        $data = [
            'test'
        ];
        $response = new Response();

        $asJson = $response->asJson($data);
        $this->assertSame('[
    "test"
]', $asJson);
    }

    public function testErrorResponse()
    {
        $response = new Response();

        $asJson = $response->returnError();
        $responseFile = file_get_contents(__DIR__ . '/../responses/invalid.json');

        $this->assertSame($responseFile, $asJson);
    }

    public function testSentenceResponse()
    {
        $response = new Response();

        $asJson = $response->returnResponse('Is it weekend yet?', 'Almost, but not yet. :(');
        $responseFile = file_get_contents(__DIR__ . '/../responses/valid.json');

        $this->assertSame($responseFile, $asJson);
    }
}

