<?php

namespace Virtual\Payment\PaymentTraits;

/**
 * @package Virtual\Payment
 */
trait PaymentGetting
{
    /**
     *
     * @return $this->card_number
     */
    public function getCardNumber()
    {
        return $this->card_number;
    }
    
    /**
     *
     * @return $this->card_holder_name
     */
    public function getCardHolderName()
    {
        return $this->card_holder_name;
    }

    /**
     *
     * @return $this->cvv
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     *
     * @return $this->exp_month
     */
    public function getExpMonth()
    {
        return $this->exp_month;
    }

    /**
     *
     * @return $this->exp_year
     */
    public function getExpYear()
    {
        return $this->exp_year;
    }

    /**
     *
     * @return void
     */
    public function getIyzicoOptions()
    {
        return $this->options;
    }

    /**
     *
     * @param $country
     * @return void
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     *
     * @return $this->city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     *
     * @return $this->registration_address
     */
    public function getRegistrationAddress()
    {
        return $this->registration_address;
    }
    
    /**
     *
     * @return $this->identity_number
     */
    public function getIdentityNumber()
    {
        return $this->identity_number;
    }

    public function getLocale()
    {
        return $this->locale;
    }
    
    /**
     *
     * @return string
     */
    public function getInstallmentCount()
    {
        return $this->installment_count;
    }

    /**
     * @return mixed
     */
    protected function getUserIp()
    {
        return $this->userIp;
    }

    /**
     *
     * @return $this->channel
     */
    public function getPaymentChannel()
    {
        return $this->channel;
    }

    /**
     *
     * @return $this->payment_group
     */
    public function getPaymentGroup()
    {
        return $this->payment_group;
    }

    /**
     *
     * @return mixed
     */
    public function getConversationId()
    {
        return $this->conversation_id;
    }
    
    /**
     *
     * @return mixed
     */
    public function getTotalPrice()
    {
        return $this->total_price;
    }

    /**
     *
     * @return int
     */
    public function getBuyerId()
    {
        return $this->buyer_id;
    }

    /**
     *
     * @return string
     */
    public function getBuyerSurname()
    {
        return $this->buyer_surname;
    }

    /**
     * @return mixed
     */
    public function getMerchantOid()
    {
        return $this->merchantOid;
    }

    /**
     * @return mixed
     */
    protected function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPaymentAmount()
    {
        return $this->payment_amount;
    }

    /**
     * @return mixed
     */
    protected function getUserBasket()
    {
        return $this->userBasket;
    }

    /**
     * @return string
     */
    protected function getBuyerUserName()
    {
        return $this->buyer_name;
    }

    /**
     *
     * @return string $this->delivery_name
     */
    public function getDeliveryName()
    {
        return $this->delivery_name;
    }

    /**
     *
     * @return $this->delivery_city
     */
    public function getDeliveryCity()
    {
        return $this->delivery_city;
    }

    /**
     *
     * @return $this->delivery_address
     */
    public function getDeliveryAddress()
    {
        return $this->delivery_address;
    }

    /**
     * @return mixed
     */
    public function getUserAddress()
    {
        return $this->userAddress;
    }

    /**
     * @return mixed
     */
    protected function getUserPhone()
    {
        return $this->userPhone;
    }

    /**
     * @return mixed
     */
    protected function getMerchantOkUrl()
    {
        return $this->merchant_ok_url;
    }

    /**
     * @return mixed
     */
    protected function getMerchantFailUrl()
    {
        return $this->merchant_fail_url;
    }

    /**
     * @return mixed
     */
    protected function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getCurlUrl(): ?string
    {
        return $this->config['curl_url'];
    }

    /**
     * @return string
     */
    public function getIyzicoToken()
    {
        $hashstr = $this->getClientID() . $this->getMerchantOid() . $this->getPaymentAmount()
                . $this->getMerchantOkUrl() . $this->getMerchantFailUrl()
                . $this->getTransactionType() . $this->getInstallmentCount()
                . $this->getRnd() . $this->getStoreKey();

        return base64_encode(pack('H*',sha1($hashstr)));
    }

    /**
     * @return false|string
     */
    private function getUserBasketAsJson()
    {
        return json_encode($this->getUserBasket());
    }

    /**
     * 
     * @return string $this->payment_type
     */
    public function getPaymentType()
    {
        return $this->payment_type;
    }

    /**
     * @return mixed
     */
    public function getMerchantId()
    {
        return $this->config['merchant_id'];
    }

    /**
     * @return string
     */
    public function getPaytrToken()
    {
        $hash = $this->getMerchantId() . $this->getUserIp() . $this->getMerchantOid() . 
                $this->getEmail() . $this->getPaymentAmount(). $this->getPaymentType() .
                $this->getInstallmentCount() . 
                $this->getCurrency() . $this->getTestMode(). $this->getNon3d();

        return base64_encode(hash_hmac('sha256', $hash . $this->getMerchantSalt(), $this->getMerchantKey(), true));
    }

    /**
     * @return mixed
     */
    function getInitialPaytrToken()
    {
        return $this->paytrToken;
    }

    /**
     * @return mixed
     */
    protected function getNoInstallment()
    {
        return $this->config['no_installment'];
    }

    /**
     * @return mixed
     */
    protected function getMaxInstallment()
    {
        return $this->config['max_installment'];
    }

    /**
     * @return mixed
     */
    protected function getTestMode()
    {
        return $this->config['test_mode'];
    }

    /**
     * @return mixed
     */
    protected function getDebugOn()
    {
        return $this->config['debug_on'];
    }

    /**
     * @return mixed
     */
    public function getMerchantKey()
    {
        return $this->config['metchant_key'];
    }

    /**
     * @return mixed
     */
    public function getMerchantSalt()
    {
        return $this->config['merchant_salt'];
    }

    /**
     * @return mixed
     */
    protected function getTimeOutLimit()
    {
        return $this->config['time_out_limit'];
    }

    /**
     *
     * @return $this->non3d_test_failed
     */
    public function getNon3dTestFailed()
    {
        return $this->non3d_test_failed;
    }

    /**
     *
     * @return void
     */
    public function getNon3d()
    {
        return $this->non_3d;
    }

    /**
     * return store_key from config
     *
     * @return string
     */
    public function getStoreKey()
    {
        return $this->store_key;
    }

    /**
     *
     * @return mixed
     */
    public function getClientID()
    {
        return $this->client_id;
    }

    /**
     *
     * @return mixed
     */
    public function getRnd()
    {
        return $this->rnd;
    }

    /**
     * @return $transactionType
     */
    public function getTransactionType()
    {
        return $this->transactionType;
    }

    /**
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @return string
     */
    public function getNestpayToken()
    {
        $hashstr = $this->getClientID() . $this->getMerchantOid() . $this->getPaymentAmount()
                . $this->getMerchantOkUrl() . $this->getMerchantFailUrl()
                . $this->getTransactionType() . $this->getRnd() . $this->getStoreKey();

        return base64_encode(pack('H*',sha1($hashstr)));
    }

    /**
     *
     * @return string
     */
    public function getStoreType()
    {
        return $this->store_type;
    }

    /**
     *
     * @return $this->girogatemobile
     */
    public function getGirogateMobile()
    {
        return $this->girogatemobile;
    }

    /**
     *
     * @return string $this->ccode
     */
    public function getCCode()
    {
        return $this->ccode;
    }

    /**
     *
     * @return $this->payment_method
     */
    public function getPaymentMethod()
    {
        return $this->payment_method;
    }

    /**
     *
     * @return $this->secret_key
     */
    public function getSecretKey()
    {
        return $this->secret_key;
    }

    /**
     *
     * @return $this->config | $config
     */
    public function getConfig($config = null)
    {
        if ( is_null($config) )
            return config($this->config);

        return config($config);
    }
}
