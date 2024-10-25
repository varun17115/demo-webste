<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderDetails extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    
    public function order_items() 
    {
        return $this->hasMany(orderItems::class , 'order_id')->with('product');
    }
    public function address_detail() 
    {
        return $this->hasOne(AddressDetails::class , 'address_id' ,'address_id');
    }
    public function user_detail()
    {
        return $this->hasOne(UserTable::class ,'id','user_id');
    }
}

