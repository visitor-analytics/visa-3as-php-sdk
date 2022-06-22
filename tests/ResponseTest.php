<?php

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Visa\Response;

class ResponseTest extends TestCase
{
    public function testGetStatusCode()
    {
        $stream = $this->createMock(\Psr\Http\Message\StreamInterface::class);
        $stream->method('getContents')
            ->willReturn(json_encode([
                'payload' => ['id' => '8ae2ef14-8da0-4f5b-906e-54cb558badd6']
            ]));

        $guzzleResponse = $this->createMock(ResponseInterface::class);

        $guzzleResponse->method('getStatusCode')->willReturn(200);
        $guzzleResponse->method('getBody')->willReturn($stream);

        $response = new Response($guzzleResponse);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetPayloadThrowsExceptionIfPayloadKeyIsNotSet()
    {
        $stream = $this->createMock(\Psr\Http\Message\StreamInterface::class);
        $stream->method('getContents')
            ->willReturn(json_encode(['id' => '8ae2ef14-8da0-4f5b-906e-54cb558badd6']));

        $guzzleResponse = $this->createMock(ResponseInterface::class);
        $guzzleResponse->method('getBody')->willReturn($stream);
        $guzzleResponse->method('getStatusCode')->willReturn(200);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Response body is missing the `payload` key');


        $response = new Response($guzzleResponse);

        $response->getPayload();
    }

    /**
     * @throws Exception
     */
    public function testGetPayloadReturnsNullIfStatusCode204()
    {
        $stream = $this->createMock(\Psr\Http\Message\StreamInterface::class);
        $stream->method('getContents')
            ->willReturn(null);

        $guzzleResponse = $this->createMock(ResponseInterface::class);
        $guzzleResponse->method('getBody')->willReturn($stream);
        $guzzleResponse->method('getStatusCode')->willReturn(204);

        $response = new Response($guzzleResponse);

        $this->assertEquals(null, $response->getPayload());
    }

    public function testGetBodyReturnsNullIfStatusCode204()
    {
        $stream = $this->createMock(StreamInterface::class);
        $stream->method('getContents')
            ->willReturn(null);

        $guzzleResponse = $this->createMock(ResponseInterface::class);
        $guzzleResponse->method('getBody')->willReturn($stream);
        $guzzleResponse->method('getStatusCode')->willReturn(204);

        $response = new Response($guzzleResponse);

        $this->assertEquals(null, $response->getBody());
    }

    public function testGetResultReturnsNullIfStatusCode204()
    {
        $stream = $this->createMock(StreamInterface::class);
        $stream->method('getContents')
            ->willReturn(null);

        $guzzleResponse = $this->createMock(ResponseInterface::class);
        $guzzleResponse->method('getBody')->willReturn($stream);
        $guzzleResponse->method('getStatusCode')->willReturn(204);

        $response = new Response($guzzleResponse);

        $this->assertEquals(null, $response->getResult());
    }
}
