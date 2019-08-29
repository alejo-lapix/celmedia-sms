<?php

namespace Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use http\Exception\InvalidArgumentException;
use Lapix\Celmedia\Sms\CelmediaSmsException;
use Lapix\Celmedia\Sms\Client;
use PHPUnit\Framework\TestCase;

/**
 * Class ClientTest
 * @package Tests
 */
class ClientTest extends TestCase
{
    /**
     * @test
     * @dataProvider requestDataProvider
     * @covers       \Lapix\Celmedia\Sms\Client::send
     *
     * @param $expectError
     * @param $mock
     * @param string $exceptionMessage
     * @throws CelmediaSmsException
     */
    public function send($expectError, $mock, $exceptionMessage = '')
    {
        $handler = HandlerStack::create($mock);
        $client = new Client(new \GuzzleHttp\Client(['handler' => $handler]), 'username', 'password', 'apiKey', 0);

        if ($expectError) {
            $this->expectException(CelmediaSmsException::class);
            $this->expectExceptionMessage($exceptionMessage);
        }

        $result = $client->send('{}');
        $this->assertNull($result);
    }

    /**
     * @test
     * @dataProvider constructorDataProvider
     * @covers       \Lapix\Celmedia\Sms\Client::__constructor
     *
     * @param $expectError
     * @param $username
     * @param $password
     * @param $apiKey
     * @param $errorMessage
     */
    public function construct($expectError, $username, $password, $apiKey, $errorMessage)
    {
        if ($expectError) {
            $this->expectException(\InvalidArgumentException::class);
            $this->expectExceptionMessage($errorMessage);
        }

        $client = new Client(new \GuzzleHttp\Client(), $username, $password, $apiKey);
        $this->assertInstanceOf(Client::class, $client);
    }

    /**
     * @return array
     */
    public function requestDataProvider()
    {
        return [
            [
                false,
                new MockHandler([
                    new Response(200),
                ]),
            ],
            [
                false,
                new MockHandler([
                    new Response(500),
                    new Response(500),
                    new Response(200),
                ]),
            ],
            [
                true,
                new MockHandler([
                    new Response(500),
                    new Response(500),
                    new Response(500),
                ]),
                'The service is not available, please try later'
            ],
            [
                true,
                new MockHandler([
                    new Response(400),
                ]),
                'Error while trying to send sms'
            ],
        ];
    }

    /**
     * @return array
     */
    public function constructorDataProvider()
    {
        return [
            [
                true,
                'not-empty',
                '',
                'not-empty',
                'Password can not be empty',
            ],
            [
                true,
                'not-empty',
                'not-empty',
                '',
                'API Key can not be empty',
            ],
            [
                true,
                '',
                'not-empty',
                'not-empty',
                'Username can not be empty',
            ],
            [
                false,
                'not-empty',
                'not-empty',
                'not-empty',
                '',
            ]
        ];
    }
}
