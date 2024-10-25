<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandDetails extends Model
{
    use HasFactory;
    protected $table = 'brand_details';
    protected $primaryKey = 'brand_id';
    protected $guarded = ['brand_id'];
}
