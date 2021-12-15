<?php

namespace Ampeco\OmnipayRapyd\Message;

class CreateCardRequest extends AbstractRequest
{
    public function getEndpoint()
    {
        return '/hosted/collect/card';
    }

    public function getData()
    {
        $this->validate('returnUrl', 'currency', 'country', 'customerId');

        return [
            'cancel_url' => $this->getReturnUrl(),
            'complete_url' => $this->getReturnUrl(),
            'country' => $this->getCountry(),
            'currency' => $this->getCurrency(),
            'customer' => $this->getCustomerId(),
            // 'payment_method_type' => 'is_visa_card',
        ];
    }
}
