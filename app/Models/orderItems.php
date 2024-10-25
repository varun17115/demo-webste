<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderItems extends Model
{
    use HasFactory;
    protected $table = 'order_items';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function product() 
    {
        return $this->hasOne(productsDetails::class ,'prod_id' ,'product_id');
    }
    public function order()
    {
        return $this->belongsTo(orderDetails::class);
    }

}
