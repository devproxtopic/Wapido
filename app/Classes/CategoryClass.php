<?php

namespace App\Classes;

use App\Models\Category;

class CategoryClass
{
    public function create($categoryData): Category
    {
        return Category::create($categoryData);
    }

    public function update($id, $categoryData): Category
    {
        $category = Category::find($id);
        $category->update($categoryData);

        return $category;
    }

    public function destroy($id)
    {
        return Category::destroy($id);
    }

    public function savePicture($id, $file)
    {
        $category = Category::find($id);
        $file->move(public_path("storage/categories"), $category->id . '.' . $file->getClientOriginalExtension());

        $category->img = "categories/" . $category->id . '.' . $file->getClientOriginalExtension();
        $category->save();

        return $category;
    }

    public function updatePricesByMeasures($items, $dataMeasures)
    {
        /**
         * Dejar los precios en los items de las cantidades que corresponden
         */
        $newPrices = null;

        foreach ($items as $item) {
            if (json_decode($item->price) != '' || json_decode($item->price) != null) {
                foreach (json_decode($item->price, true) as $price) {
                    for ($i = 0; $i < count($dataMeasures); $i++) {
                        if ($price['quantity'] == $dataMeasures[$i]) {
                            $newPrices[] = $price;
                        }
                    }
                }

                $item->price = json_encode($newPrices);
                $item->save();
            }
        }
    }
}
