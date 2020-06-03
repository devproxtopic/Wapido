<?php

namespace App\Classes;
use App\Models\Order;

class OrderClass
{
    public function create($orderData): Order
    {
        return Order::create($orderData);
    }

    public function update($id, $orderData): Order
    {
        $order = Order::find($id);
        return $order->update($orderData);
    }

    public function destroy($id)
    {
        return Order::destroy($id);
    }
}
