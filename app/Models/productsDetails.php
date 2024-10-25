<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productsDetails extends Model
{
    use HasFactory;
    protected $table = 'products_details';
    protected $primaryKey = 'prod_id';
    protected $guarded = ['prod_id'];
    
    
    public function favourites()
    {
        return $this->belongsTo(favouriteItems::class);
    }
    public function product_detail()
    {
        return $this->belongsTo(orderItems::class);
    }
}
