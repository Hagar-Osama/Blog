<?php

namespace App\Http\Traits;


trait ProductTrait {

    public function getProductById($productId)
    {
        return $this->productModel::findOrFail($productId);
    }
}

