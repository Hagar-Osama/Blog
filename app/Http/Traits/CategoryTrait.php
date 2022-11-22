<?php

namespace App\Http\Traits;


trait CategoryTrait {

    public function getAllCategories()
    {
        return $this->categoryModel::get();
    }

    public function getCategoryById($catgoryId)
    {
        return $this->categoryModel::findOrFail($catgoryId);
    }
}

