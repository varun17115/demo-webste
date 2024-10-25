<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


use Illuminate\Foundation\Auth\User as Authenticatable;   

class UserImages extends Model
{
    protected $table = 'user_images';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    
}
