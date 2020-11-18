<?php

namespace Virtual\Payment\Nestpay;


use Exception;

/**
 * Class Curl
 * @package Virtual\Payment\Nestpay
 */
class Curl
{    
    /**
     * @var
     */
    private $curl;

    /**
     * @var int $timeout
     */
    private $timeout = 20;

    /**
     * @var bool $sslVerifyHost
     */
    private $sslVerifyHost = false;


    /**
     * @var bool $returnTransfer
     */
    private $returnTransfer = true;

    /**
     * @var bool $freshConnect
     */
    private $freshConnect = true;

    /**
     * Curl constructor curl_init
     *
     */
    public function __construct()
    {
        $this->curl = curl_init();
    }

    /**
     * @param mixed $timeout
     */
    public function setTimeout($timeout): void
    {
        $this->timeout = $timeout;
    }

    /**
     * @return mixed
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }


    /**
     * @return bool
     */
    public function isSslVerifyHost(): bool
    {
        return $this->sslVerifyHost;
    }

    /**
     * @param bool $sslVerifyHost
     */
    public function setSslVerifyHost(bool $sslVerifyHost): void
    {
        $this->sslVerifyHost = $sslVerifyHost;
    }

    /**
     * @return bool
     */
    public function isReturnTransfer(): bool
    {
        return $this->returnTransfer;
    }

    /**
     * @param bool $returnTransfer
     */
    public function setReturnTransfer(bool $returnTransfer): void
    {
        $this->returnTransfer = $returnTransfer;
    }

    /**
     * @return bool
     */
    public function isFreshConnect(): bool
    {
        return $this->freshConnect;
    }

    /**
     * @param bool $freshConnect
     */
    public function setFreshConnect(bool $freshConnect): void
    {
        $this->freshConnect = $freshConnect;
    }

    /**
     * @param NestpayInterface $payment
     * @return mixed
     * @throws Exception
     *
     */
    public function send(NestpayInterface $payment)
    {
        try {

            $fields = $this->setPostField($payment->query());
            
            curl_setopt($this->curl, CURLOPT_URL, $payment->getCurlUrl());
            curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, $this->isReturnTransfer());
            curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($this->curl, CURLOPT_POST, 1);
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, $this->isSslVerifyHost());
            curl_setopt($this->curl, CURLOPT_FRESH_CONNECT, $this->isFreshConnect());
            curl_setopt($this->curl, CURLOPT_TIMEOUT, $this->getTimeout());

           return curl_exec($this->curl);

        } catch (\Exception $th) {

            return array(
                'status'        => false,
                'message'       => 'Banka ile bağlantı gerçekleştirilemedi .',
            );
        }
    }

    /**
     * @param array $query
     * @return string
     */
    public function setPostField($query)
    {
        $postFields = [];

        foreach ($query as $key => $value) {
            $postFields[] = $key . '=' . $value;
        }

        return implode('&', $postFields);
    }

    /**
     * @return void
     */
    public function __destruct()
    {
        curl_close($this->curl);
    }
}
