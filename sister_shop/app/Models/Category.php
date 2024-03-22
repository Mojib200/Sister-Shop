<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use softdeletes;
    protected $guarded = [];
    function relation_to_user(){

        return $this->belongsTo(User::class,'addedby');
    }
}
