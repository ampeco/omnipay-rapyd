<?php

namespace Ampeco\OmnipayRapyd\Message;

class DeleteCardRequest extends AbstractRequest
{
    public function getEndpoint()
    {
        $this->validate('customerId', 'token');

        return "customers/{$this->getCustomerId()}/payment_methods/{$this->getToken()}";
    }

    public function getHttpMethod()
    {
        return 'DELETE';
    }

    public function getData()
    {
        return [];
    }
}
