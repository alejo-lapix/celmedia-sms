<?php

namespace Lapix\Celmedia\Sms;

use \InvalidArgumentException;

/**
 * Class Sms
 * @package Lapix\Celmedia\Sms
 */
class Sms
{
    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $phoneNumber;

    /**
     * @var string
     */
    private $identifier;

    /**
     * Sms constructor.
     * @param string $message
     * @param string $phoneNumber
     * @param string $identifier
     */
    public function __construct(string $message, string $phoneNumber, string $identifier)
    {
        if (empty($message)) {
            throw new InvalidArgumentException('The message can not be empty');
        }

        if (empty($phoneNumber)) {
            throw new InvalidArgumentException('The phone number can not be empty');
        }

        if (!preg_match('/^\d{5,15}$/', $phoneNumber)) {
            throw new InvalidArgumentException('The phone number must be numeric and have between 5 and 15 numbers');
        }

        $this->message = $message;
        $this->phoneNumber = $phoneNumber;
        $this->identifier = $identifier;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }
}
