<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressDetails extends Model
{
    use HasFactory;
    protected $table = 'address_details';
    protected $primaryKey = 'address_id';
    protected $guarded = ['address_id'];

    public function address()
    {
        return $this->belongsTo(orderDetails::class );
    }
}
