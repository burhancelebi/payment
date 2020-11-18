<?php

namespace Virtual\Payment\PaymentTraits;

trait PaymentSetting
{
    /**
     * @param $card_number
     * @return void
     */
    public function setCardNumber($card_number)
    {
        $this->card_number = $card_number;
    }
    
    /**
     *
     * @param array $config
     * @return void
     */
    public function setConfig($config)
    {
        $this->config = config($config);
    }

    /**
     *
     * @param string $card_holder_name
     * @return void
     */
    public function setCardHolderName(string $card_holder_name)
    {
        $this->card_holder_name = $card_holder_name;
    }

    /**
     *
     * @param $cvv
     * @return void
     */
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
    }

    /**
     *
     * @param $exp_month
     * @return void
     */
    public function setExpMonth($exp_month)
    {
        $this->exp_month = $exp_month;
    }

    /**
     *
     * @param $exp_year
     * @return void
     */
    public function setExpYear($exp_year)
    {
        $this->exp_year = $exp_year;
    }

    /**
     * Setting iyzico options
     *
     * @return void
     */
    public function setIyzicoOptions()
    {
        $this->options = new \Iyzipay\Options();
        
        $this->options->setApiKey($this->config['api_key']);
        $this->options->setSecretKey($this->config['secret_key']);
        $this->options->setBaseUrl($this->config['base_url']);
    }

    /**
     *
     * @param string $country
     * @return void
     */
    public function setCountry(string $country)
    {
        $this->country = $country;
    }

    /**
     *
     * @param string $city
     * @return void
     */
    public function setCity(string $city)
    {
        $this->city = $city;
    }

    /**
     *
     * @param string $registration_address
     * @return void
     */
    public function setRegistrationAddress(string $registration_address)
    {
        $this->registration_address = $registration_address;
    }

    /**
     *
     * @param string $identity_number
     * @return void
     */
    public function setIdentityNumber(string $identity_number)
    {
        $this->identity_number = $identity_number;
    }

    /**
     *
     * @param $locale
     * @return void
     */
    public function setLocale($locale = false)
    {
        $this->locale = $this->config['locale'];

        if ( $locale )
            $this->locale = $locale;
    }

    /**
     * @return void
     * @param $installment_count
     */
    public function setInstallmentCount( $installment_count = false )
    {
        $this->installment_count = $this->config['installment_count'];

        if ( $installment_count )
            $this->installment_count = $installment_count;
    }

    /**
     *
     * @param mixed $currency
     * @return void
     */
    public function setCurrency($currency = false)
    {
        $this->currency = $this->config['currency'];

        if ( $currency )
            $this->currency = $currency;
    }

    /**
     * set payment channel from config or send parameter
     *
     * @param mixed $channel
     * @return void
     */
    public function paymentChannel($channel = false)
    {
        $this->channel = $this->config['payment_channel'];

        if ( $channel )
            $this->channel = $channel;
    }

    /**
     * set payment group from config or send parameter
     *
     * @param mixed $payment_group
     * @return void
     */
    public function paymentGroup($payment_group = false)
    {
        $this->payment_group = $this->config['payment_group'];

        if ( $payment_group )
            $this->payment_group = $payment_group;
    }
    
    /**
     * @param $userIp
     */
    public function setUserIp( $userIp = false)
    {
        $this->userIp = request()->ip();
        
        if ( $userIp )
            $this->userIp = $userIp;
    }

    /**
     *
     * @param $conversation_id
     * @return mixed
     */
    public function setConversationId($conversation_id)
    {
        $this->conversation_id = $conversation_id;
    }

    /**
     *
     * @return mixed
     */
    public function setTotalPrice($total_price)
    {
        $this->total_price = $total_price;
    }

    /**
     *
     * @param integer $buyer_id
     * @return void
     */
    public function setBuyerId($buyer_id)
    {
        $this->buyer_id = $buyer_id;
    }

    /**
     *
     * @param $buyer_surname
     * @return void
     */
    public function setBuyerSurname($buyer_surname)
    {
        $this->buyer_surname = $buyer_surname;
    }

    /**
     *
     * @param string $delivery_name
     * @return void
     */
    public function setDeliveryName(string $delivery_name)
    {
        $this->delivery_name = $delivery_name;
    }

    /**
     *
     * @param string $delivery_city
     * @return void
     */
    public function setDeliveryCity(string $delivery_city)
    {
        $this->delivery_city = $delivery_city;
    }

    /**
     *
     * @param string $delivery_address
     * @return void
     */
    public function setDeliveryAddress(string $delivery_address)
    {
        $this->delivery_address = $delivery_address;
    }

    /**
     * @param $merchantOid
     */
    public function setMerchantOid($merchantOid)
    {
        $this->merchantOid = $merchantOid;
    }

    /**
     * @param string $email
     * @return void
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @param $payment_amount
     */
    public function setPaymentAmount($payment_amount)
    {
        $this->payment_amount = $payment_amount;
    }

    /**
     * @param $iyzicoToken
     */
    public function setIyzicoToken($iyzicoToken)
    {
        $this->iyzicoToken = $iyzicoToken;
    }

    /**
     * @param $userBasket
     */
    public function setUserBasket($userBasket)
    {
        $this->userBasket = $userBasket;
    }

    /**
     * @param $buyer_name
     */
    public function setBuyerUserName($buyer_name)
    {
        $this->buyer_name = $buyer_name;
    }

    /**
     * @param $userAddress
     */
    public function setUserAddress($userAddress)
    {
        $this->userAddress = $userAddress;
    }

    /**
     * @param $userPhone
     */
    public function setUserPhone($userPhone)
    {
        $this->userPhone = $userPhone;
    }

    /**
     *
     * @param $payment_type
     * @return void
     */
    public function setPaymentType($payment_type = false)
    {
        $this->payment_type = $this->config['payment_type'];
        
        if ( $payment_type )
            $this->payment_type = $payment_type;        
    }

    /**
     * @param $paytrToken
     */
    public function setPaytrToken($paytrToken)
    {
        $this->paytrToken = $paytrToken;
    }

    /**
     *
     * @param $merchant_fail_url
     * @return void
     */
    public function setMerchantOkUrl($merchant_ok_url = false)
    {
        $this->merchant_ok_url = $this->config['merchant_ok_url'];

        if ( $merchant_ok_url )
            $this->merchant_ok_url = $merchant_ok_url;
    }

    /**
     *
     * @param $merchant_fail_url
     * @return void
     */
    public function setMerchantFailUrl($merchant_fail_url = false)
    {
        $this->merchant_fail_url = $this->config['merchant_fail_url'];

        if ( $merchant_fail_url )
            $this->merchant_fail_url = $merchant_fail_url;
    }

    /**
     *
     * @param $non3d_test_failed
     * @return void
     */
    public function setNon3dTestFailed($non3d_test_failed = false)
    {
        $this->non3d_test_failed = $this->config['non3d_test_failed'];

        if ( $non3d_test_failed )
            $this->non3d_test_failed = $non3d_test_failed;
    }

    /**
     *
     * @param $non_3d
     * @return void
     */
    public function setNon3d($non_3d = false)
    {
        $this->non_3d = $this->config['non_3d'];
        
        if ( $non_3d )
            $this->non_3d = $non_3d;
    }

    /**
     *
     * @param $rnd
     * @return void
     */
    public function setRnd($rnd = false)
    {
        $this->rnd = microtime(true);
        
        if ( $rnd )
            $this->rnd = $rnd;
    }

    /**
     * set payment page language
     *
     * @param boolean $lang
     * @return void
     */
    public function setLang($lang = false)
    {
        $this->lang = $this->config['lang'];

        if ( $lang )
            $this->lang = $lang;
    }

    /**
     *
     * @param string $transactionType
     * @return void
     */
    public function setTransactionType(string $transactionType)
    {
        $this->transactionType = $transactionType;
    }

    /**
     * @param $nestpayToken
     */
    public function setNestpayToken($nestpayToken)
    {
        $this->nestpayToken = $nestpayToken;
    }

    /**
     * clientID from config
     *
     * @return void
     */
    public function setClientID()
    {
        $this->client_id = $this->config['client_id'];
    }

    /**
     * store_key from config
     * 
     * @return void
     */
    public function setStoreKey()
    {
        $this->store_key = $this->config['nestpay_store_key'];
    }

    /**
     * Set nestpay store type. Default value is in config['storetype'] file
     * 
     * @param $store_type
     * @return void
     */
    public function setStoreType($store_type = false)
    {
        $this->store_type = $this->config['storetype'];

        if ( $store_type )
            $this->store_type = $store_type;
    }

    /**
     *
     * @param string $girogatemobile
     * @return void
     */
    public function setGirogateMobile(string $girogatemobile)
    {
        $this->girogatemobile = $girogatemobile;
    }

    /**
     *
     * @param string $ccode
     * @return void
     */
    public function setCCode(string $ccode)
    {
        $this->ccode = $ccode;
    }

    /**
     *
     * @param string $payment_method
     * @return void
     */
    public function setPaymentMethod(string $payment_method = null)
    {
        $this->payment_method = $this->config['payment_method'];

        if ( $payment_method )
            $this->payment_method = $payment_method;
    }

    /**
     *
     * @return void
     */
    public function setSecretKey($secret_key = false)
    {
        $this->secret_key = $this->config['secret_key'];

        if ( $secret_key )
            $this->secret_key = $secret_key;
    }
}
