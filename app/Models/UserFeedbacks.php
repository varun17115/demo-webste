<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFeedbacks extends Model
{
    use HasFactory;
    protected $table = 'user_feedbacks';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
