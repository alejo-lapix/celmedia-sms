<?php

namespace Lapix\Celmedia\Sms;

/**
 * Interface Encoder
 * @package Lapix\Celmedia\Sms
 */
interface Encoder
{
    /**
     * @param Sms[] $messages
     * @return string
     */
    public function encode(array $messages): string;
}
