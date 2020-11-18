<?php

namespace Virtual\Payment\Nestpay;

use Virtual\Payment\PaymentTraits\PaymentGetting;
use Virtual\Payment\PaymentTraits\PaymentSetting;

abstract class NestpayBuilder
{
    private
        $merchantOid,
        $config,
        $paymentAmount,
        $transactionType = 'Auth',
        $store_type,
        $merchant_fail_url,
        $merchant_ok_url,
        $store_key,
        $rnd,
        $lang,
        $client_id,
        $currency,
        $userIp,
        $email,
        $userBasket,
        $buyer_name,
        $userAddress,
        $cvv,
        $exp_month,
        $exp_year,
        $card_holder_name,
        $payment_type,
        $girogatemobile,
        $ccode,
        $userPhone;
        
    use PaymentSetting, PaymentGetting;
    
}