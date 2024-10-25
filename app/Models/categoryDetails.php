<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoryDetails extends Model
{
    use HasFactory;
    protected $table = 'category_details';
    protected $primaryKey = 'cat_id';
    protected $guarded = ['cat_id'];
    
}
