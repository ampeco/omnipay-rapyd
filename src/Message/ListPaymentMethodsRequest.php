<?php

namespace Ampeco\OmnipayRapyd\Message;

class ListPaymentMethodsRequest extends AbstractRequest
{
    public function getEndpoint()
    {
        $this->validate('customerId');

        return "/customers/{$this->getCustomerId()}/payment_methods";
    }

    public function getHttpMethod()
    {
        return 'GET';
    }

    public function getData()
    {
        return [];
    }

    protected function getResponseClass()
    {
        return ListPaymentMethodsResponse::class;
    }
}
