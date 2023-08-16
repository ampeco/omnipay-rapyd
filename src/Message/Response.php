<?php

namespace Ampeco\OmnipayRapyd\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\ResponseInterface;

class Response extends AbstractResponse implements ResponseInterface, RedirectResponseInterface
{
    const STATUS_SUCCESS = 'SUCCESS';

    protected int $statusCode;

    public function __construct(RequestInterface $request, $data, $statusCode)
    {
        $this->request = $request;
        $this->data = json_decode($data, true);
        $this->statusCode = (int) $statusCode;
    }

    public function getRequest(): AbstractRequest
    {
        return $this->request;
    }

    public function isSuccessful()
    {
        return $this->statusCode < 400 && $this->getStatus() === self::STATUS_SUCCESS;
    }

    public function isRedirect()
    {
        return !! $this->getRedirectUrl();
    }

    public function getRedirectUrl()
    {
        return @$this->data['data']['redirect_url'];
    }

    public function getTransactionReference()
    {
        return @$this->data['data']['id'];
    }

    public function getStatus()
    {
        return @$this->data['status']['status'];
    }

    public function getCode()
    {
        return @$this->data['status']['error_code'];
    }

    public function getMessage()
    {
        return @$this->data['status']['message'] ?? '';
    }
}
