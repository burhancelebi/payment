<?php

namespace Virtual\Payment;

trait Message
{
    private $except = ['fail_message', 'message', 'status'];
    private $status = false;
    private $message = 'Ödeme başarısız.';
    
    /**
     * This function is get data from payment class then return message
     *
     * @return array
     */
    public function getIyzicoMessage()
    {
        if ( request()->input('status') == 'success' ) {
            $this->message = 'Ödeme başarıyla gerçekleşti.';
            $this->status = true;
        }

        $except = request()->except($this->except);
        return array_merge($this->response(), $except);
    }

    public function getPaytrMessage()
    {
        if ( !request()->has('fail_message') ) {
            $this->message = 'Ödeme başarıyla gerçekleşti.';
            $this->status = true;
        }

        $except = request()->except($this->except);
        return array_merge($this->response(), $except);
    }

    public function getZiraatMessage()
    {
        if ( request()->input('mdStatus') ) {
            $this->message = 'Ödeme başarıyla gerçekleşti.';
            $this->status = true;
        }

        $except = request()->except($this->except);
        return array_merge($this->response(), $except);
    }

    public function getIsBankMessage()
    {
        if ( request()->input('Response') == 'Approved' ) {
            $this->message = 'Ödeme başarıyla gerçekleşti.';
            $this->status = true;
        }

        $except = request()->except($this->except);
        return array_merge($this->response(), $except);
    }

    public function response()
    {
        return array(
            'status'        => $this->status,
            'message'       => $this->message,
        );
    }

    public function except(...$elements)
    {
        foreach ($elements as $key => $value) {
            array_push($this->except, $value);
        }
        
        return $this;
    }
}