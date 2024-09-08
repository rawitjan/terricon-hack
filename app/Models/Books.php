<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    public function another_books_author()
    {
        return $this->hasMany(Books::class, 'authors', 'authors')->limit(3);
    }

    public function another_books_category()
    {
        return $this->hasMany(Books::class, 'categories', 'categories')->limit(3);
    }

    public function comments()
    {
        return $this->hasMany(Rating::class, 'book_id', 'id');
    }

    public function rating()
    {
        return ($this->hasMany(Rating::class, 'book_id', 'id')->avg('star')) ? $this->hasMany(Rating::class, 'book_id', 'id')->avg('star') : 0;
    }


    public function ratings()
    {
        return $this->hasMany(Rating::class, 'book_id', 'id');
    }
}
