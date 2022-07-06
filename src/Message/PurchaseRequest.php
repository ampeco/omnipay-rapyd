<?php

namespace Ampeco\OmnipayRapyd\Message;

class PurchaseRequest extends AbstractRequest
{
    public function setCapture($value)
    {
        $this->setParameter('capture', (bool) $value);
    }

    public function getCapture()
    {
        return $this->getParameter('capture');
    }

    public function getEndpoint()
    {
        return 'payments';
    }

    public function getData()
    {
        $this->validate('amount', 'currency', 'token', 'description', 'capture');

        return [
            'initiation_type' => 'unscheduled',
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency(),
            'payment_method' => $this->getToken(),
            'description' => $this->getDescription(),
            'capture' => $this->getCapture(),
        ];
    }
}
