<?php

namespace App\Builders\Order;

use App\Models\Order;

class OrderBuilder implements OrderBuilderInterface {

    /**
     * @var Order $order
     */
    private $order;

    public function __construct() {
        $this->reset();
    }


    public function reset(): void {
        $this->order = new Order();
    }

    public function setCart()
    {
        // TODO: Implement getCart() method.
    }

    public function setPayment()
    {
        // TODO: Implement getPayment() method.
    }

    public function setOrder()
    {

    }

    public function getOrder()
    {
        return $this->order;
    }


}
