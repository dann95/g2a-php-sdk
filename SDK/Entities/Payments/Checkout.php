<?php

namespace G2A\Entities\Payments;

use G2A\Entities\AbstractEntity;

class Checkout extends AbstractEntity
{
    protected $status;

    protected $token;

    /**
     * @return bool
     */
    public function success()
    {
        return 'ok' == $this->status;
    }

    /**
     * @return string
     */
    public function redirect()
    {
        return $this->sdk->endpoints()->quote().'gateway?token='.$this->token;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }
}
