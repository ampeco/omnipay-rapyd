<?php

namespace Ampeco\OmnipayRapyd\Message;

class CaptureRequest extends AbstractRequest
{
    public function getEndpoint()
    {
        $this->validate('transactionReference');

        return "payments/{$this->getTransactionReference()}/capture";
    }

    public function getData()
    {
        $this->validate('amount');

        return [
            "amount" => $this->getAmount(),
        ];
    }
}
