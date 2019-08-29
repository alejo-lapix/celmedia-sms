<?php

namespace Lapix\Celmedia\Sms;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use InvalidArgumentException;

/**
 * Class Client
 * @package Lapix\Celmedia\Sms
 */
class Client
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var int
     */
    private $maxTries;

    /**
     * @var int
     */
    private $msRetriesDelay;

    /**
     * Client constructor.
     * @param \GuzzleHttp\Client $client
     * @param string $username
     * @param string $password
     * @param string $apiKey
     * @param int $msDelay
     */
    public function __construct(
        \GuzzleHttp\Client $client,
        string $username,
        string $password,
        string $apiKey,
        int $msDelay = 500
    ) {
        if (empty($username)) {
            throw new InvalidArgumentException('Username can not be empty');
        }

        if (empty($password)) {
            throw new InvalidArgumentException('Password can not be empty');
        }

        if (empty($apiKey)) {
            throw new InvalidArgumentException('API Key can not be empty');
        }

        $this->client = $client;
        $this->apiKey = $apiKey;
        $this->username = $username;
        $this->password = $password;
        $this->maxTries = 3;
        $this->msRetriesDelay = $msDelay;
    }

    /**
     * @param string $body
     * @param int $tries
     * @return mixed
     *
     * @throws CelmediaSmsException
     */
    public function send(string $body, int $tries = 0)
    {
        try {
            $this->client->post(
                'https://apisms.celmedia.com.co/api_sendsms',
                [
                    'headers' => $this->headers(),
                    'body' => $body
                ]
            );
        } catch (ServerException $e) {
            if (++$tries === $this->maxTries) {
                throw new CelmediaSmsException('The service is not available, please try later', 0, $e);
            }

            // 500ms
            usleep(1000 * $this->msRetriesDelay);

            return $this->send($body, $tries);
        } catch (RequestException $e) {
            // TODO Handle error properly
            throw new CelmediaSmsException('Error while trying to send sms', 0, $e);
        }
    }

    /**
     * @return array
     */
    private function headers(): array
    {
        return [
            'Authorization' => sprintf("Basic %s", base64_encode("{$this->username}:{$this->password}")),
            'Content-Type' => 'application/json',
            'api-key' => $this->apiKey,
        ];
    }
}
