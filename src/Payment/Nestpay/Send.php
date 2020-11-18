<?php

namespace Virtual\Payment\Nestpay;

use Virtual\Payment\Nestpay\NestpayInterface;

class Send
{
    /**
     * @param Nestpay $payment
     * @return bool
     */
    function toNestPay(NestpayInterface $payment)
    {
        $curl = new Curl();
        $curl->setTimeout(15);
        
        return $curl->send($payment);
    }
}