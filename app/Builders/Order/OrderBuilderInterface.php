<?php

namespace App\Builders\Order;

interface OrderBuilderInterface {

    public function setCart();

    public function setPayment();

    public function setOrder();

    public function getOrder();
}
