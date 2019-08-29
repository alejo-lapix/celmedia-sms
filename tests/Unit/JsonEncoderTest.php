<?php

namespace Tests;

use Lapix\Celmedia\Sms\JsonEncoder;
use Lapix\Celmedia\Sms\Sms;
use PHPUnit\Framework\TestCase;

/**
 * Class JsonEncoderTest
 * @package Tests
 */
class JsonEncoderTest extends TestCase
{
    /**
     * @test
     * @dataProvider encodeDataProvider
     * @covers       \Lapix\Celmedia\Sms\JsonEncoder::encode
     *
     * @param $messages
     * @param $expected
     */
    public function encode($messages, $expected)
    {
        $this->assertEquals($expected, (new JsonEncoder())->encode($messages));
    }

    public function encodeDataProvider()
    {
        $smsTemplate = '{"movil":"%s","mensaje":"%s","identificadorcliente":"%s"}';

        return [
            [
                [],
                '[]',
            ],
            [
                [new Sms('Message', '123456', '1234'), new Sms('a', '12345', '')],
                sprintf(
                    "[%s,%s]",
                    sprintf($smsTemplate, '123456', 'Message', '1234'),
                    sprintf($smsTemplate, '12345', 'a', '')
                ),
            ]
        ];
    }
}
