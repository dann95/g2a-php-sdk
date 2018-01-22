<?php

namespace G2A\Entities\Payments;

use G2A\Entities\AbstractEntity;

class Checkout extends AbstractEntity
{
    private $status;
    private $token;

    /**
     * @return bool
     */
    public function success()
    {
        return $this->status == 'ok';
    }

    /**
     * @return string
     */
    public function redirect()
    {
        return $this->sdk->endpoints()->quote()."gateway?token=".$this->token;
    }
}