<?php

namespace App\Http\Traits;


trait BlogTrait {

    public function getBlogById($blogId)
    {
        return $this->blogModel::findOrFail($blogId);
    }
}

