<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    public function readers(){
        return 0;
    }

    public function entryed(){
        return 1;
    }

    public function collections(){
        return $this->hasMany(Collection::class, 'user_id', 'id');
    }

    public function posts(){
        return $this->hasMany(Posts::class, 'club_id', 'id');
    }
}
