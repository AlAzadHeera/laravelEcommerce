<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function Brands(){
        return $this->belongsTo(Brand::class);
    }

    public function Categories(){
        return $this->belongsTo(Category::class);
    }
}
