<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $guarded = [];
    function relation_to_product_info(){

        return $this->belongsTo(Product::class,'product_id');
    }
    function relation_to_color_info(){

        return $this->belongsTo(Color::class,'color_id');
    }
    function relation_to_size_info(){

        return $this->belongsTo(Size::class,'size_id');

}
}
