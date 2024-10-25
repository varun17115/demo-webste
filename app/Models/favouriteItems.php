<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favouriteItems extends Model
{
    use HasFactory;
    protected $table = 'liked_products';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    

    public function favourites()
    {
        return $this->hasOne(productsDetails::class,'prod_id' ,'product_id');
    }
}
