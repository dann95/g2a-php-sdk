<?php

namespace G2A\Entities\Payments;

use G2A\Entities\AbstractEntity;

class Checkout extends AbstractEntity
{
    private $status;
    private $token;
}