<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    public function books(){
        return $this->hasMany(CollectionBooks::class, 'collection_id', 'id');
    }
}
