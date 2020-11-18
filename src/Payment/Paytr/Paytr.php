<?php

namespace Virtual\Payment\Paytr;

use Virtual\Payment\Message;

class Paytr extends PaytrBuilder implements PaytrInterface
{
    use Message;
    
    public function __construct()
    {
        $this->setConfig('payment.connections.paytr');
        $this->setPaymentType();
        $this->setMerchantOkUrl();
        $this->setMerchantFailUrl();
        $this->setCurrency();
        $this->setInstallmentCount();
        $this->setNon3dTestFailed();
        $this->setNon3d();
    }

    /**
     * @return array
     */
    public function query(): array
    {
        return array(
            'merchant_id'           => $this->getMerchantId(),
            'user_ip'               => $this->getUserIp(),
            'merchant_oid'          => $this->getMerchantOid(),
            'email'                 => $this->getEmail(),
            'payment_amount'        => $this->getPaymentAmount(),
            'paytr_token'           => $this->getPaytrToken(),
            'payment_type'          => $this->getPaymentType(),
            'installment_count'     => $this->getInstallmentCount(),
            'user_basket'           => json_encode($this->getUserBasket()),
            'debug_on'              => $this->getDebugOn(),
            'no_installment'        => $this->getNoInstallment(),
            'max_installment'       => $this->getMaxInstallment(),
            'user_name'             => $this->getBuyerUserName(),
            'user_address'          => $this->getUserAddress(),
            'user_phone'            => $this->getUserPhone(),
            'merchant_ok_url'       => $this->getMerchantOkUrl(),
            'merchant_fail_url'     => $this->getMerchantFailUrl(),
            'timeout_limit'         => $this->getTimeOutLimit(),
            'currency'              => $this->getCurrency(),
            'test_mode'             => $this->getTestMode(),
            'non3d_test_failed'     => $this->getNon3dTestFailed(),
            'non_3d'                => $this->getNon3d(),

            
            'cc_owner'              => $this->getCardHolderName(),
            'card_number'           => $this->getCardNumber(),
            'expiry_month'          => $this->getExpMonth(),
            'expiry_year'           => $this->getExpYear(),
            'cvv'                   => $this->getCvv(),
        );
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function send()
    {
        $send = new Send();
        $result = $send->toPayTr($this);
        
        return $result;
    }
}