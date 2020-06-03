<?php

namespace App\Classes;
use App\Models\Promotion;

class PromotionClass
{
    public function create($promotionData): Promotion
    {
        return Promotion::create($promotionData);
    }

    public function update($id, $promotionData): Promotion
    {
        $promotion = Promotion::find($id);
        return $promotion->update($promotionData);
    }

    public function destroy($id)
    {
        return Promotion::destroy($id);
    }
}
