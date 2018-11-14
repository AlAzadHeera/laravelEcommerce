<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function menus(){
        return $this->hasMany(Menu::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
