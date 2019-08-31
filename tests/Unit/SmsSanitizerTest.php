<?php

namespace Tests;

use Lapix\Celmedia\Sms\SmsSanitizer;
use PHPUnit\Framework\TestCase;

/**
 * Class SmsSanitizerTest
 * @package Tests
 */
class SmsSanitizerTest extends TestCase
{
    /**
     * @param $expected
     * @param $currentValue
     *
     * @test
     * @dataProvider dataProvider
     */
    public function sanitize($expected, $currentValue)
    {
        $sanitizer = new SmsSanitizer();

        $this->assertEquals($expected, $sanitizer->sanitize($currentValue));
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            ['Example Test', 'Example Test'],
            ['aAeEiIoOuUYnNyYyY', 'áÁéÉíÍóÓúÚ&ñÑýÝÿŸ¡'],
            // TODO Add tests
        ];
    }
}
