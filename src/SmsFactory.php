<?php

namespace Lapix\Celmedia\Sms;

/**
 * Class SmsFactory
 * @package Lapix\Celmedia\Sms
 */
class SmsFactory
{
    /**
     * @var Sanitizer
     */
    private $sanitizer;

    /**
     * SmsFactory constructor.
     * @param Sanitizer $sanitizer
     */
    public function __construct(Sanitizer $sanitizer)
    {
        $this->sanitizer = $sanitizer;
    }

    /**
     * @param string $message
     * @param string $phoneNumber
     * @param string $identifier
     * @return Sms
     */
    public function createSms(string $message, string $phoneNumber, string $identifier): Sms
    {
        return new Sms(
            $this->sanitizer->sanitize($message),
            $phoneNumber,
            $identifier
        );
    }
}
