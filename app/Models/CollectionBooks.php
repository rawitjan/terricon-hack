<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionBooks extends Model
{
    use HasFactory;

    public function data(){
        return $this->hasOne(Books::class, 'id', 'book_id');
    }
}
