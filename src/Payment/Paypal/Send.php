<?php

namespace Virtual\Payment\Paypal;

use PayPal\Exception\PayPalConnectionExceptio;

class Send
{
    public function send(Paypal $paypal)
    {
        try {
            
            $paypal->payment->create($paypal->_api_context);

        } catch (PayPalConnectionExceptio $e) {
            return [
                'status'    => false,
                'code'      => null,
                'data'      => [
                    $e->getData()
                ],
            ];
        }

        $approvalUrl = $paypal->payment->getApprovalLink();

        return redirect($approvalUrl);
    }
}