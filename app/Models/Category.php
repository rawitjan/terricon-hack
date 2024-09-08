<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    public static function list(){
        return DB::table('books')->select('categories')->distinct()->pluck('categories');
    }

    public static function list_rand(){
        return DB::table('books')
        ->select('categories')
        ->distinct() // Выбираем только уникальные значения
        ->inRandomOrder() // Перемешиваем результаты случайным образом
        ->take(4) // Ограничиваем выборку 3 записями
        ->pluck('categories'); // Получаем значения в виде коллекции
    }
}
