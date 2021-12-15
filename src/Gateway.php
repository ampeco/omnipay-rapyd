<?php

namespace Ampeco\OmnipayRapyd;

use Ampeco\OmnipayRapyd\Message\AbstractRequest;
use Ampeco\OmnipayRapyd\Message\CaptureRequest;
use Ampeco\OmnipayRapyd\Message\CreateCustomerRequest;
use Ampeco\OmnipayRapyd\Message\PurchaseRequest;
use Ampeco\OmnipayRapyd\Message\CreateCardRequest;
use Ampeco\OmnipayRapyd\Message\DeleteCardRequest;
use Ampeco\OmnipayRapyd\Message\GetTransactionRequest;
use Ampeco\OmnipayRapyd\Message\VoidRequest;
use Omnipay\Common\AbstractGateway;

/**
 * @method \Omnipay\Common\Message\NotificationInterface acceptNotification(array $options = [])
 * @method \Omnipay\Common\Message\AbstractRequest completeAuthorize(array $options = [])
 * @method \Omnipay\Common\Message\AbstractRequest completePurchase(array $options = [])
 * @method \Omnipay\Common\Message\AbstractRequest refund(array $options = [])
 * @method \Omnipay\Common\Message\AbstractRequest fetchTransaction(array $options = [])
 * @method \Omnipay\Common\Message\AbstractRequest updateCard(array $options = [])
 */
class Gateway extends AbstractGateway
{
    use CommonParameters;

    public function getName()
    {
        return 'Rapyd';
    }

    public function authorize(array $options = []): AbstractRequest
    {
        return $this->createRequest(PurchaseRequest::class, array_merge($options, ['hold' => true]));
    }

    public function capture(array $options = []): AbstractRequest
    {
        return $this->createRequest(CaptureRequest::class, $options);
    }

    public function void(array $options = []): AbstractRequest
    {
        return $this->createRequest(VoidRequest::class, $options);
    }

    public function purchase(array $options = []): AbstractRequest
    {
        return $this->createRequest(PurchaseRequest::class, array_merge($options, ['hold' => false]));
    }

    public function createCard(array $options = []): AbstractRequest
    {
        return $this->createRequest(CreateCardRequest::class, $options);
    }

     public function deleteCard(array $options = []): AbstractRequest
     {
         return $this->createRequest(DeleteCardRequest::class, $options);
     }

     public function createCustomer(array $options = []): AbstractRequest
     {
         return $this->createRequest(CreateCustomerRequest::class, $options);
     }

    // public function getTransaction(array $options = []): AbstractRequest
    // {
    //     return $this->createRequest(GetTransactionRequest::class, $options);
    // }

    // public function checkCreateCard(array $options = []): AbstractRequest
    // {
    //     return $this->createRequest(CheckCreateCardRequest::class, $options);
    // }
}
