<?php

use Iyzipay\Model\PaymentGroup;
use Iyzipay\Model\PaymentChannel;

return [

    'connections'   => [
        
        'paytr' => [
            'merchant_id'       => env('MERCHANT_ID', 'your_merchant_id'),
            'metchant_key'      => env('MERCHANT_KEY', 'your_metchant_key'),
            'merchant_salt'     => env('MERCHANT_SALT', 'your_merchant_salt'),
            'merchant_ok_url'   => env('MERCHANT_OK_URL', 'http://127.0.0.1:8000/paytr-result'),
            'merchant_fail_url' => env('MERCHANT_FAIL_URL', 'http://127.0.0.1:8000/paytr-fail'),
            'curl_url'          => 'https://www.paytr.com/odeme',
            'payment_type'      => 'card',
            'installment_count' => "0",
            'currency'          => 'TL',
            'time_out_limit'    => 30,
            'debug_on'          => 1,
            'test_mode'         => 1,
            'no_installment'    => 0,
            'max_installment'   => 0,
            'non_3d'            => 0,
            'non3d_test_failed' => 0,
        ],

        'nestpay' => [

            'ziraat' => [
                'nestpay_name'      => env('NESTPAY_NAME', 'nestpay_name'),
                'nestpay_password'  => env('NESTPAY_PASSWORD', 'nestpay_password'),
                'client_id'         => env('ZIRAAT_CLIENTID', 'client_id'),
                'nestpay_store_key' => env('NESTPAY_STORE_KEY', 'nestpay_store_key'),
                'merchant_ok_url'   => env('MERCHANT_OK_URL', 'http://127.0.0.1:8000/nestpay-result'),
                'merchant_fail_url' => env('MERCHANT_FAIL_URL', 'http://127.0.0.1:8000/nestpay-fail'),
                'curl_url'          => 'https://entegrasyon.asseco-see.com.tr/fim/est3Dgate',
                'storetype'         => "3d_pay",
                'installment_count' => "",
                'lang'              => 'tr',
                'currency'          => '949',
            ],

            'isbank' => [
                'nestpay_name'      => env('NESTPAY_NAME', 'nestpay_name'),
                'nestpay_password'  => env('NESTPAY_PASSWORD', 'nestpay_password'),
                'client_id'         => env('ISBANK_CLIENTID', 'client_id'),
                'nestpay_store_key' => env('NESTPAY_STORE_KEY', 'nestpay_store_key'),
                'merchant_ok_url'   => env('MERCHANT_OK_URL', 'http://127.0.0.1:8000/is-bankasi-success'),
                'merchant_fail_url' => env('MERCHANT_FAIL_URL', 'http://127.0.0.1:8000/is-bankasi-fail'),
                'curl_url'          => 'https://entegrasyon.asseco-see.com.tr/fim/est3Dgate',
                'storetype'         => "3D_PAY",
                'payment_type'      => 'GIROGATE_GIROPAY',
                'installment_count' => "",
                'lang'              => 'tr',
                'currency'          => '978',
            ],
        ],

        'iyzico' => [
            'base_url'          => 'https://sandbox-api.iyzipay.com',
            'api_key'           => 'your_api_key',
            'secret_key'        => 'your_secret_key',
            'merchant_ok_url'   => env('IYZİCO_OK_URL', 'http://127.0.0.1:8000/iyzico-result/'),
            'locale'            => 'tr',
            'currency'          => 'TRY',
            'installment_count' => 1,
            'payment_group'     => PaymentGroup::PRODUCT,
            'payment_channel'   => PaymentChannel::WEB,
        ],

        'paypal' => [
            'client_id'         => env('PAYPAL_CLIENT_ID', ''),
            'secret_key'        => env('PAYPAL_SECRET', ''),
            'merchant_ok_url'   => env('MERCHANT_OK_URL', 'http://127.0.0.1:8000/paypal-success'),
            'merchant_fail_url' => env('MERCHANT_FAIL_URL', 'http://127.0.0.1:8000/paypal-fail'),
            'payment_method'    => env('PAYMENT_METHOD', 'paypal'),
            'settings' => [
                'mode'                      => env('PAYPAL_MODE', 'sandbox'),
                'http.ConnectionTimeOut'    => 30,
                'log.LogEnabled'            => true,
                'log.FileName'              => public_path() . '/paypal.log',
                'log.LogLevel' => 'ERROR'
            ],
        ],
    ]
];