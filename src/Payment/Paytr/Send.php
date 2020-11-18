<?php

namespace Virtual\Payment\Paytr;

class Send
{
    /**
     * @param Paytr $payment
     * @return bool
     */
    function toPayTr(Paytr $paytr)
    {
        $curl = new Curl();
        $curl->setTimeout(15);
        
        return $curl->send($paytr);
    }
}