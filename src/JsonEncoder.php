<?php

namespace Lapix\Celmedia\Sms;

/**
 * Class SmsEncoder
 * @package Lapix\Celmedia\Sms
 */
class JsonEncoder implements Encoder
{
    /**
     * @param Sms[] $messages
     * @return string
     */
    public function encode(array $messages): string
    {
        $content = [];

        foreach ($messages as $sms) {
            $content[] = [
                'movil' => $sms->getPhoneNumber(),
                'mensaje' => $sms->getMessage(),
                'identificadorcliente' => $sms->getIdentifier(),
            ];
        }

        return \GuzzleHttp\json_encode($content);
    }
}
