<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function author(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function replyes(){
        return $this->hasMany(Comment::class, 'reply_id', 'id');
    }
}
