<?php

namespace Virtual\Payment\Paypal;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Payee;
use Virtual\Payment\Paypal\Send;

class Paypal extends PaypalBuilder
{
    public $_api_context , $payment;
    
    public function __construct()
    {
        $this->payment = new Payment();

        $this->setConfig('payment.connections.paypal');
        $this->setClientID();
        $this->setSecretKey();
        $this->setPaymentMethod();
        $this->setMerchantOkUrl();
        $this->setMerchantFailUrl();
        
        $this->_api_context = $this->oauthLogin();
        
        $this->_api_context->setConfig($this->getConfig('payment.connections.paypal.settings'));

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($this->getMerchantOkUrl())
            ->setCancelUrl($this->getMerchantFailUrl());
            
        $this->payment->setRedirectUrls($redirectUrls)
                        ->setPayer($this->payer());
    }
    
    public function details()
    {
        return new Details();
    }

    public function transaction()
    {
        return new Transaction();
    }

    public function amount()
    {
        return new Amount();
    }

    public function ItemList()
    {
        return new ItemList();
    }

    public function item()
    {
        return new Item();
    }

    public function payer()
    {
        $payer = new Payer();

        $payer->setPaymentMethod('paypal');

        return $payer;
    }

    public function oauthLogin()
    {
        return new ApiContext(new OAuthTokenCredential(
                $this->getClientID(),
                $this->getSecretKey())
            );
    }

    public function send()
    {
        $send = new Send();
        return $send->send($this);
    }

    public function paymentStatus()
    {
        if ( request()->has('PayerID') ) {

            try {

                $payment = $this->payment->get(request()->get('paymentId'), $this->_api_context);
                $execution = new PaymentExecution();
                $execution->setPayerId(request()->get('PayerID'));
                $result = $payment->execute($execution, $this->_api_context);

                return $result;

            } catch (\Exception $e) {

                return [
                    'status'    => false,
                    'code'      => null,
                    'data'      => [
                        $e->getMessage()
                    ],
                ];
            }
        }
    }

    public function failResult()
    {
        return [
            'status'    => false,
            'message'   => 'İşlem Başarısız',
            'data'      => [
                'token'     => request()->get('token'),
            ]
        ];
    }
}