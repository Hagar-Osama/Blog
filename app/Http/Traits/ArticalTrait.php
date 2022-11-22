<?php

namespace App\Http\Traits;


trait ArticalTrait {

    public function getArticalById($articalId)
    {
        return $this->articalModel::findOrFail($articalId);
    }
}

