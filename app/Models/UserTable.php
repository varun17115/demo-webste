<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


use Illuminate\Foundation\Auth\User as Authenticatable;   

class UserTable extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'firstname',
        'email',
        'password',
        'lastname',
        'phone'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $table = 'ajax_data';

    public function orders() 
    {
        return $this->belongsTo(orderDetails::class  );
    }
    
}
