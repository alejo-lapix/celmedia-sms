<?php

namespace Lapix\Celmedia\Sms;

/**
 * Interface Sanitizer
 * @package Lapix\Celmedia\Sms
 */
interface Sanitizer
{
    /**
     * @param string $body
     * @return string
     */
    public function sanitize(string $body): string;
}
