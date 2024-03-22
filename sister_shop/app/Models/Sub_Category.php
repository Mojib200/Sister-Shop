<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    function relation_to_sub_category(){

        return $this->belongsTo(Category::class,'category_id');
    }
    function relation_to_user(){

        return $this->belongsTo(User::class,'addedby');
    }

}
