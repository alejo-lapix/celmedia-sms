<?php

namespace Lapix\Celmedia\Sms;

/**
 * Class SmsSender
 * @package Lapix\Celmedia\Sms
 */
class SmsSender
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var Encoder
     */
    private $encoder;

    /**
     * SmsSender constructor.
     * @param Client $client
     * @param Encoder $encoder
     */
    public function __construct(Client $client, Encoder $encoder)
    {
        $this->client = $client;
        $this->encoder = $encoder;
    }

    /**
     * @param Sms[] $messages
     * @throws CelmediaSmsException
     */
    public function send(array $messages)
    {
        $content = $this->encoder->encode($messages);
        $this->client->send($content);
    }

    /**
     * @param Sms $sms
     * @throws CelmediaSmsException
     */
    public function sendSingle(Sms $sms)
    {
        $this->send([$sms]);
    }
}
