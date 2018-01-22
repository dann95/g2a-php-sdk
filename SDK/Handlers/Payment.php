<?php

namespace G2A\Handlers;

use G2A\Checkout\Cart;
use G2A\Handlers\AbstractHandler;
use G2A\Transformers\CheckoutTransformer;
use G2A\Transformers\PaymentTransformer;
use GuzzleHttp\Psr7\Request;

class Payment extends AbstractHandler
{
    /**
     * @param $id
     * @return \G2A\Entities\AbstractEntity|\G2A\Entities\Collections\EntityCollection
     */
    public function find($id)
    {
        $request = new Request('get', 'https://api.myjson.com/bins/dth61');
        $transformer = new PaymentTransformer();
        return $this->handleApiRequest($request, $transformer);
    }

    public function create(Cart $cart = null)
    {
        $body = <<<STRING
api_hash=d860e380-4894-40c6-8eec-c32313f6e4bb
&hash={$this->sdk->crypto()->payment('2845', 15, 'BRL', $this->sdk->credentials()->getSecret())}
&order_id=2845
&amount=15
&currency=BRL
&url_failure=http://gisa.ninja
&url_ok=http://gisa.ninja
&items=[{"sku":"450","name":"Test Item","amount":"15","type":"item_type","qty":"1","price":15,"id":"5619","url":"http://example.com/products/item/example-item-name-5619"}]
STRING;
        $request = new Request('post', 'https://checkout.test.pay.g2a.com/index/createQuote',['Content-Type' => 'application/x-www-form-urlencoded'], $body);
//        $request = new Request('post', 'https://requestb.in/11pcyz91',['Content-Type' => 'application/x-www-form-urlencoded'], $body);
        $transformer = new CheckoutTransformer();
        return $this->handleApiRequest($request, $transformer);
    }

    public function refund(\G2A\Entities\Payments\Payment $payment, $amount = null)
    {

    }
}