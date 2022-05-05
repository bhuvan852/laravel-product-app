<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productcategory extends Model
{
    use HasFactory;

     public function product_category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

}
