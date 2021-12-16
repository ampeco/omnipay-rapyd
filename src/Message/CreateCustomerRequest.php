<?php

namespace Ampeco\OmnipayRapyd\Message;

class CreateCustomerRequest extends AbstractRequest
{
    public function getEmail()
    {
        return $this->getParameter('email');
    }

    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    public function getUserId()
    {
        return $this->getParameter('userId');
    }

    public function setUserId($value)
    {
        return $this->setParameter('userId', $value);
    }

    public function getName()
    {
        return $this->getParameter('name');
    }

    public function setName($value)
    {
        return $this->setParameter('name', $value);
    }

    public function getEndpoint()
    {
        return 'customers';
    }

    public function getData()
    {
        $this->validate('userId', 'name');

        return [
            'email' => $this->getEmail(),
            'metadata' => [
                'id' => $this->getUserId(),
            ],
            'name' => $this->getName(),
        ];
    }
}
