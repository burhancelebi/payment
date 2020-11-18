<?php

namespace Virtual\Payment\Nestpay\Banks;

use Virtual\Payment\Message;
use Virtual\Payment\Nestpay\NestpayBuilder;
use Virtual\Payment\Nestpay\NestpayInterface;
use Virtual\Payment\Nestpay\Send;

class Ziraat extends NestpayBuilder implements NestpayInterface
{
    use Message;
    
    public function __construct()
    {
        $this->setConfig('payment.connections.nestpay');
        $this->setInstallmentCount(1);
        $this->setClientID();
        $this->setCurrency('949');
        $this->setRnd();
        $this->setLang();
        $this->setStoreType();
        $this->setStoreKey();
        $this->setMerchantOkUrl();
        $this->setMerchantFailUrl();
    }

    /**
     * @return array
     */
    public function query(): array
    {
        $query = array(
            'clientid'                          => $this->getClientID(),
            'oid'                               => $this->getMerchantOid(),
            'amount'                            => $this->getPaymentAmount(),
            'okUrl'                             => $this->getMerchantOkUrl(),
            'failUrl'                           => $this->getMerchantFailUrl(),
            'islemtipi'                         => $this->getTransactionType(),
            'rnd'                               => $this->getRnd(),
            'hash'                              => $this->getNestpayToken(),
            'storetype'                         => $this->getStoreType(),
            'currency'                          => $this->getCurrency(),
            'lang'                              => $this->getLang(),
            'Ecom_Payment_Card_ExpDate_Month'   => $this->getExpMonth(),
            'Ecom_Payment_Card_ExpDate_Year'    => $this->getExpYear(),
            'pan'                               => $this->getCardNumber(),
            'cv2'                               => $this->getCvv(),
        );

        // dd( $query );
        return $query;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function send()
    {
        $send = new Send();
        $result = $send->toNestPay($this);

        return $result;
    }
}