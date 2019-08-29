<?php

namespace Tests;

use Lapix\Celmedia\Sms\Sms;
use PHPUnit\Framework\TestCase;

/**
 * Class SmsTest
 * @package Tests
 */
class SmsTest extends TestCase
{
    /**
     * @param $expectError
     * @param $text
     * @param $phone
     * @param $identifier
     * @param string $errorMessage
     *
     * @test
     * @dataProvider smsConstructorDataProvider
     * @covers \Lapix\Celmedia\Sms\Sms::__construct
     */
    public function construct($expectError, $text, $phone, $identifier, $errorMessage = '')
    {
        if ($expectError) {
            $this->expectException(\InvalidArgumentException::class);
            $this->expectExceptionMessage($errorMessage);
        }

        $sms = new Sms($text, $phone, $identifier);
        $this->assertInstanceOf(Sms::class, $sms);
    }

    /**
     * @test
     * @covers \Lapix\Celmedia\Sms\Sms::getMessage
     * @covers \Lapix\Celmedia\Sms\Sms::getPhoneNumber
     * @covers \Lapix\Celmedia\Sms\Sms::getIdentifier
     */
    public function getters()
    {
        $text = 'message';
        $phoneNumber = '1234567';
        $id = 'qwerty';

        $sms = new Sms($text, $phoneNumber, $id);

        $this->assertEquals($text, $sms->getMessage());
        $this->assertEquals($phoneNumber, $sms->getPhoneNumber());
        $this->assertEquals($id, $sms->getIdentifier());
    }

    public function smsConstructorDataProvider()
    {
        return [
            [
                true,
                '',
                '',
                '',
                'The message can not be empty',
            ],
            [
                true,
                'example',
                '',
                '',
                'The phone number can not be empty',
            ],
            [
                true,
                'example',
                '+5723453425',
                '',
                'The phone number must be numeric and have between 5 and 15 numbers',
            ],
            [
                true,
                'example',
                '1234',
                '',
                'The phone number must be numeric and have between 5 and 15 numbers',
            ],
            [
                false,
                'example',
                '4114859234',
                'Any ID',
            ],
        ];
    }
}
