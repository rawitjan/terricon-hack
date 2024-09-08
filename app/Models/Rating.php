<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    public function reader()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function book()
    {
        return $this->belongsTo(Books::class, 'id', 'book_id');
    }
}
