<?php

namespace Ampeco\OmnipayRapyd\Message;

use Ampeco\OmnipayRapyd\CommonParameters;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    use CommonParameters;

    const ENDPOINT_PRODUCTION = 'https://api.rapyd.net/v1';
    const ENDPOINT_TESTING = 'https://sandboxapi.rapyd.net/v1';

    abstract public function getEndpoint();

    public function getBaseUrl()
    {
        return $this->getTestMode() ? self::ENDPOINT_TESTING : self::ENDPOINT_PRODUCTION;
    }

    public function getHeaders(): array
    {
        return [];
    }

    public function getHttpMethod()
    {
        return 'POST';
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
        $headers = array_merge($this->getHeaders(), $this->createSignature(), [
            'Content-Type' => 'application/json',
            'access_key' => $this->getAccessKey(),
        ]);

        $httpResponse = $this->httpClient->request(
            $this->getHttpMethod(),
            rtrim($this->getBaseUrl(), '/') . "/" . ltrim($this->getEndpoint(), '/'),
            $headers,
            json_encode($data),
        );

        return $this->createResponse(
            $httpResponse->getBody()->getContents(),
            $httpResponse->getStatusCode(),
        );
    }

    protected function createSignature()
    {
        $elements = [
            strtolower($this->getHttpMethod()),
             '/v1/'. ltrim($this->getEndpoint(), '/'),
             $salt = substr(base64_encode(random_bytes(16)), 0, 16),
             $timestamp = intval(microtime(true)),
             $this->getAccessKey(),
             $this->getSecretKey(),
             json_encode($this->getData(), JSON_UNESCAPED_SLASHES)
        ];

        $signature = implode('', $elements);
        $hashed = base64_encode(hash_hmac("sha256", $signature, $this->getSecretKey()));

        info('headers', [
            'elements' => $elements,
            'singature' => $signature,
            'hased' => $hashed,
        ]);

        return [
            'signature' => $hashed,
            'salt' => $salt,
            'timestamp' => $timestamp,
        ];
    }

    protected function createResponse($data, $statusCode)
    {
        $responseClass = $this->getResponseClass();

        return $this->response = new $responseClass($this, $data, $statusCode);
    }

    protected function getResponseClass()
    {
        return Response::class;
    }
}
