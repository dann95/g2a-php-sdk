<?php

namespace G2A\Checkout;

class Cart
{
    /**
     * @var array
     */
    private $items = [];
    /**
     * @var string
     */
    private $surl;
    /**
     * @var string
     */
    private $furl;

    private $address;

    /**
     * Cart constructor.
     * @param $successUrl
     * @param $failUrl
     */
    public function __construct($successUrl, $failUrl)
    {
        $this->surl = $successUrl;
        $this->furl = $failUrl;
    }

    /**
     * @param Item $item
     * @return $this
     */
    public function add(Item $item)
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * @param Address $address
     * @return $this
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
        return $this;
    }

    public function __toCheckout()
    {
        //@todo return array for Guzzle send request.
    }
}