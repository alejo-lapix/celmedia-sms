<?php

namespace Tests\Integration;

use Lapix\Celmedia\Sms\Client;
use Lapix\Celmedia\Sms\JsonEncoder;
use Lapix\Celmedia\Sms\SmsFactory;
use Lapix\Celmedia\Sms\SmsSanitizer;
use Lapix\Celmedia\Sms\SmsSender;
use PHPUnit\Framework\TestCase;

/**
 * Class SmsSenderTest
 * @package Tests\Integration
 */
class SmsSenderTest extends TestCase
{
    /**
     * @test
     * @coversNothing
     */
    public function sendSingle()
    {
        if (getenv('INTEGRATION_TEST') !== 'true') {
            self::markTestSkipped('Integration test skipped');
        }

        $sanitizer = new SmsSanitizer();
        $createSms = new SmsFactory($sanitizer);

        $sender = new SmsSender(
            new Client(
                new \GuzzleHttp\Client(),
                getenv('CELMEDIA_USER'),
                getenv('CELMEDIA_PASSWORD'),
                getenv('CELMEDIA_API_KEY')
            ),
            new JsonEncoder()
        );

        $result = $sender->sendSingle($createSms->createSms('Test méssage', getenv('CELMEDIA_TEST_PHONE'), '123456'));
        $this->assertNull($result);
    }
}
