<?php

namespace Virtual\Payment\Paytr;

use Virtual\Payment\PaymentTraits\PaymentGetting;
use Virtual\Payment\PaymentTraits\PaymentSetting;

abstract class PaytrBuilder
{
    private
        $merchantOid,
        $merchant_fail_url,
        $merchant_ok_url,
        $config,
        $userIp,
        $email,
        $payment_amount,
        $paytrToken,
        $userBasket,
        $buyer_name,
        $userAddress,
        $userPhone,
        $payment_type,
        $cvv,
        $exp_month,
        $exp_year,
        $currency,
        $card_holder_name,
        $non3d_test_failed,
        $non_3d;

    use PaymentSetting, PaymentGetting;
    
}