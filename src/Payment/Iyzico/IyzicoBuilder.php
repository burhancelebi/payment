<?php

namespace Virtual\Payment\Iyzico;

use Virtual\Payment\PaymentTraits\PaymentSetting;
use Virtual\Payment\PaymentTraits\PaymentGetting;

abstract class IyzicoBuilder
{
    private
        $options,
        $merchantOid,
        $config,
        $paymentAmount,
        $installment_count,
        $currency,
        $userIp,
        $email,
        $userBasket,
        $buyer_name,
        $userPhone,
        $userAddress,
        $card_number,
        $cvv,
        $exp_month,
        $exp_year,
        $card_holder_name,
        $locale,
        $channel,
        $payment_group,
        $conversation_id,
        $total_price,
        $buyer_id,
        $delivery_name,
        $delivery_city,
        $delivery_address,
        $merchant_ok_url,
        $country,
        $city,
        $registration_address,
        $identity_number,
        $buyer_surname;
        
    use PaymentSetting, PaymentGetting;
    
}