<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Category;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = Books::with('ratings')
            ->leftJoin('ratings', 'books.id', '=', 'ratings.book_id')
            ->select('books.*', DB::raw('AVG(ratings.star) as average_rating'))
            ->groupBy('books.id')
            ->orderByDesc('average_rating')
            ->paginate(5);

        $posts = Posts::paginate(10);
        return view('home', ['books' => $books, 'posts' => $posts]);
    }

    public function welcome()
    {
        $categoryes = Category::list()->toArray();
        $categoryes_limit = Category::list_rand()->toArray();
        $books = Books::paginate(12);
        return view('welcome', [
            'categoryes' => $categoryes,
            'categoryes_limit' => $categoryes_limit,
            'books' => $books
        ]);
    }
}
