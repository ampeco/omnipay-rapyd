<?php

namespace Ampeco\OmnipayRapyd\Message;

class VoidRequest extends AbstractRequest
{
    public function getEndpoint()
    {
        $this->validate('transactionReference');

        return "payments/{$this->getTransactionReference()}";
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
