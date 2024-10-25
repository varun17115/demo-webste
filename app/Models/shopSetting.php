<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shopSetting extends Model
{
    use HasFactory;
    protected $table = 'shop_setting';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
