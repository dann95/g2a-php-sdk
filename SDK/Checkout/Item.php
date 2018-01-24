<?php

namespace G2A\Checkout;

class Item
{
    private $sku;

    private $name;

    private $price;

    private $qty;

    private $id;

    private $url;

    private $extra;

    private $type;

    /**
     * Item constructor.
     *
     * @param null $sku
     * @param null $name
     * @param null $price
     * @param null $qty
     * @param null $id
     * @param null $url
     * @param null $extra
     * @param null $type
     */
    public function __construct($sku = null,
                                $name = null,
                                $price = null,
                                $qty = null,
                                $id = null,
                                $url = null,
                                $extra = null,
                                $type = null)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->qty = $qty;
        $this->id = $id;
        $this->url = $url;
        $this->extra = $extra;
        $this->type = $type;
    }

    /**
     * @param $sku
     *
     * @return $this
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param $qty
     *
     * @return $this
     */
    public function setQty($qty)
    {
        $this->qty = $qty;

        return $this;
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param $extra
     *
     * @return $this
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;

        return $this;
    }

    /**
     * @param $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return array
     */
    public function __toCart()
    {
        return array_filter(get_object_vars($this), function ($i) {
            return null !== $i;
        }) + ['amount' => $this->price * $this->qty];
    }
}
