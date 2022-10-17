<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    function categories(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    function subcategories(){
        return $this->hasOne(Subcategory::class, 'id', 'subcategory_id');
    }
    protected $fillable = ['product_image'];
}
