<?php

namespace Lapix\Celmedia\Sms;

/**
 * Class SmsSanitizer
 * @package Lapix\Celmedia\Sms
 */
class SmsSanitizer implements Sanitizer
{
    /**
     * @param string $body
     * @return string
     */
    public function sanitize(string $body): string
    {
        return str_replace($this->remove(), $this->replaceWith(), $body);
    }

    /**
     * @return string[]
     */
    private function replaceWith(): array
    {
        return array_values($this->specialCharacters());
    }

    /**
     * @return string[]
     */
    private function remove(): array
    {
        return array_keys($this->specialCharacters());
    }

    /**
     * @return array
     */
    private function specialCharacters(): array
    {
        return [
            'á' => 'a',
            'Á' => 'A',
            'é' => 'e',
            'É' => 'E',
            'í' => 'i',
            'Í' => 'I',
            'ó' => 'o',
            'Ó' => 'O',
            'ú' => 'u',
            'Ú' => 'U',
            '^' => '',
            '`' => '',
            '¬' => '',
            '‘' => '',
            '“' => '',
            '*' => '',
            '#' => '',
            'ª' => 'a',
            'º' => 'o',
            '>' => '',
            '<' => '',
            'ü' => 'u',
            '[' => '(',
            ']' => ')',
            '¿' => '',
            '¡' => '',
            'ñ' => 'n',
            'Ñ' => 'N',
            'ý' => 'y',
            'Ý' => 'Y',
            'ÿ' => 'y',
            'Ÿ' => 'Y',
            '{' => '(',
            '}' => ')',
            '\\' => '',
            '/' => '',
            '|' => '',
            '&' => 'Y',
            '~' => '-',
            ';' => ',',
            '½' => '1/2',
            '¼' => '1/4',
            '¾' => '3/4',
        ];
    }
}
