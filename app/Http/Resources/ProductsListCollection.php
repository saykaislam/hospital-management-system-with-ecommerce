<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsListCollection extends ResourceCollection
{
    public function toArray($request)
    {
        //return 'products collections';
        return [
            'data' => $this->collection->map(function($data) {
                $productPrice = productPrice($data->id);
                return [
                    'id' => $data->id,
                    'name' => $data->name,
                    'thumbnail_image' => $data->thumbnail_img,
                    //'unit_price' => (double) $data->unit_price,
                    'unit_price' => (double) $productPrice['unit_price'],
                    'discount_price' => (double) $productPrice['discount_price'],
                    //'discount' => (double) $data->discount,
                    //'discount_type' => $data->discount_type,
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
