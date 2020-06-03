<?php

namespace App\Classes;
use App\Models\Item;

class ItemClass
{
    public function create($itemData): Item
    {
        return Item::create($itemData);
    }

    public function update($id, $itemData): Item
    {
        $item = Item::find($id);
        return $item->update($itemData);
    }

    public function destroy($id)
    {
        return Item::destroy($id);
    }
}
