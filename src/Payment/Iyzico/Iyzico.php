<?php

namespace Virtual\Payment\Iyzico;

use Iyzipay\Request\CreatePaymentRequest;
use Iyzipay\Request\CreateThreedsPaymentRequest;
use Iyzipay\Model\Address;
use Iyzipay\Model\PaymentCard;
use Iyzipay\Model\Buyer;
use Iyzipay\Model\BasketItem;
use Iyzipay\Model\ThreedsInitialize;
use Iyzipay\Model\Locale;
use Iyzipay\Model\ThreedsPayment;
use Iyzipay\Model\Payment;
use Virtual\Payment\Message;

class Iyzico extends IyzicoBuilder implements IyzicoInterface
{
    public
        $request,
        $address,
        $payment_card,
        $buyer,
        $basket_items = array();

    use Message;
    
    public function __construct()
    {
        $this->payment_card = new PaymentCard();
        $this->request = new CreatePaymentRequest();
        
        $this->setConfig('payment.connections.iyzico');
        $this->setIyzicoOptions();
        $this->setlocale();
        $this->setCurrency();
        $this->setInstallmentCount(1);
        $this->paymentChannel(1);
        $this->paymentGroup(1);
        $this->setMerchantOkUrl();
    }

    /**
     * @return array
     */
    public function query(): array
    {
        return array(
            'client_id'             => $this->getClientID(),
            'user_ip'               => $this->getUserIp(),
            'merchant_oid'          => $this->getMerchantOid(),
            'merchant_ok_url'       => $this->getMerchantOkUrl(),
            'merchant_fail_url'     => $this->getMerchantFailUrl(),
            'currency'              => $this->getCurrency(),
            'rnd'                   => $this->getRnd(),
            'transactionType'       => $this->getTransactionType(),
            'store_key'             => $this->getStoreKey(),
            'hashstr'               => $this->getNestpayToken(),
            'email'                 => $this->getEmail(),
            'payment_amount'        => $this->getPaymentAmount(),
            'installment_count'     => $this->getInstallmentCount(),
            'user_basket'           => json_encode($this->getUserBasket()),
            'user_name'             => $this->getUserName(),
            'user_address'          => $this->getUserAddress(),
            'user_phone'            => $this->getUserPhone(),
        );
    }
    
    public function init3D()
    {
        $this->request->setCallbackUrl($this->getMerchantOkUrl());
        
        $this->payment = ThreedsInitialize::create($this->request, $this->getIyzicoOptions());
        
        return $this->payment;
    }

    public function non3D()
    {
        $this->payment = Payment::create($this->request, $this->getIyzicoOptions());
        
        return $this->payment;
    }

    public function request()
    {
        $this->request->setLocale($this->getlocale());
        $this->request->setCurrency($this->getCurrency());
        $this->request->setInstallment($this->getInstallmentCount());
        $this->request->setPaymentChannel($this->getPaymentChannel());
        $this->request->setPaymentGroup($this->getPaymentGroup());

        return $this->request;
    }

    public function address()
    {
        $address = new Address();

        $address->setCity($this->getCity());
        $address->setContactName($this->getBuyerUserName());
        $address->setCountry($this->getCountry());
        $address->setAddress($this->getUserAddress());

        return $address;
    }

    public function paymentCard()
    {
        $card = $this->payment_card;
        $card->setCardHolderName($this->getCardHolderName());
        $card->setCardNumber($this->getCardNumber());
        $card->setCvc($this->getCvv());
        $card->setExpireMonth($this->getExpMonth());
        $card->setExpireYear($this->getExpYear());

        return $card;
    }

    public function buyer()
    {
        $buyer = new Buyer();

        $buyer->setName($this->getBuyerUserName());
        $buyer->setSurname($this->getBuyerSurname());
        $buyer->setGsmNumber($this->getUserPhone());
        $buyer->setEmail($this->getEmail());
        $buyer->setIdentityNumber($this->getIdentityNumber());
        $buyer->setRegistrationAddress($this->getRegistrationAddress());
        $buyer->setIp($this->getUserIp());
        $buyer->setCity($this->getCity());
        $buyer->setCountry($this->getCountry());

        return $buyer;
    }

    public function basketItem()
    {
        return new BasketItem();
    }

    public function appendItem($item)
    {
        array_push($this->basket_items, $item);

        return $this->basket_items;
    }
}