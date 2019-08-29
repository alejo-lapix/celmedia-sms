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
        return str_replace($this->specialCharacters(), $this->replaceWith(), $body);
    }

    /**
     * @return string[]
     */
    private function replaceWith(): array
    {
        return [
            'a',
            'A',
            'e',
            'E',
            'i',
            'I',
            'o',
            'O',
            'u',
            'U',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            'a',
            'o',
            '',
            '',
            'u',
            '(',
            ')',
            '',
            '',
            'n',
            'N',
            '(',
            ')',
            '',
            '',
            '',
            'Y',
            '-',
            ',',
            '1/2',
            '1/4',
            '3/4',
        ];
    }

    /**
     * @return string[]
     */
    private function specialCharacters()
    {

        return [
            'á',
            'Á',
            'é',
            'É',
            'í',
            'Í',
            'ó',
            'Ó',
            'ú',
            'Ú',
            '^',
            '`',
            '¬',
            '‘',
            '“',
            '*',
            '#',
            'ª',
            'º',
            '>',
            '<',
            'ü',
            '[',
            ']',
            '¿',
            '¡',
            'ñ',
            'Ñ',
            '{',
            '}',
            '\\',
            '/',
            '|',
            '&',
            '~',
            ';',
            '½',
            '¼',
            '¾',
        ];
    }
}
