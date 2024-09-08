<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    public function author(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function club(){
        return $this->hasOne(Club::class, 'id', 'club_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'parent_id', 'id')->where([
            ['model', '=', 'posts'],
            ['reply_id', '=', null]
        ]);
    }

    public function last_comments(){
        return $this->hasOne(Comment::class, 'parent_id', 'id')->where([
            ['model', '=', 'posts']
        ])->orderBy('id', 'desc')->limit(1);
    }
}
