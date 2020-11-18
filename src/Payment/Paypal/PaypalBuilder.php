<?php

namespace Virtual\Payment\Paypal;

use Virtual\Payment\PaymentTraits\PaymentSetting;
use Virtual\Payment\PaymentTraits\PaymentGetting;

abstract class PaypalBuilder
{
    protected
        $client_id,
        $secret_key,
        $merchant_fail_url,
        $merchant_ok_url,
        $payment_method,
        $config;

    use PaymentSetting, PaymentGetting;
}
