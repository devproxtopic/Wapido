<?php

namespace App\Classes;
use App\Models\OrderDetail;

class OrderDetailClass
{
    public function create($orderDetailData): OrderDetail
    {
        return OrderDetail::create($orderDetailData);
    }

    public function update($id, $orderDetailData): OrderDetail
    {
        $orderDetail = OrderDetail::find($id);
        return $orderDetail->update($orderDetailData);
    }

    public function destroy($id)
    {
        return OrderDetail::destroy($id);
    }
}
