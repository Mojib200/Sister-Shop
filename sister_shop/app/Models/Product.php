<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    function relation_to_category(){

        return $this->belongsTo(Category::class,'category_id');
    }
    function relation_to_sub_category(){

        return $this->belongsTo(Sub_Category::class,'subcategory_id');
    }
    function relation_to_sub_inventory_for_searching(){

        return $this->hasMany(Inventory::class,'product_id');
    }
}
