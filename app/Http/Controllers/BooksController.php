<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\CollectionBooks;
use App\Models\Posts;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{
    public function index(){
        return view('app.books.all', [
            'books' => Books::paginate(12)
        ]);
    }

    public function get($id){
        $book = Books::findOrFail($id);
        return view('app.books.get', [
            'book' => $book
        ]);
    }

    public function search(Request $request){
        $query = Books::query();

        if ($request->title) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }
        if ($request->authors) {
            $query->where('authors', 'like', '%' . $request->authors . '%');
        }
        if ($request->categories) {
            $query->where('categories', 'like', '%' . $request->categories . '%');
        }
        if ($request->publish_year) {
            $query->where('publish_year', $request->publish_year);
        }
        $books = $query->paginate(12);

        return view('app.books.all', [
            'books' => $books
        ]);
    }

    public function exchange_list(){
        $posts = Posts::where([
            ['type', '=', 'books_exchange'],
            ['ended', '=', '0']
        ])->select(['type', 'ended', 'id'])->get();

        return view('app.books.exchange', [
            'posts' => $posts
        ]);
    }

    public function exchange_publish(Request $exc){
        $e = new Posts();
        $e->type = 'books_exchange';
        $e->user_id = Auth::user()->id;

        $thumbnail = $exc->file('thumbnail');

        $e->thumbnail = "data:image/jpeg;base64,".base64_encode(file_get_contents($thumbnail->getRealPath()));
        $e->body = $exc->body;
        $e->data = json_encode($exc->data);
        $e->save();

        return redirect()->route('books.exchange');
    }

    public function comment($id, Request $comment){
        $c = new Rating();
        $c->star = $comment->star;
        $c->book_id = $id;
        $c->user_id = Auth::user()->id;
        $c->body = $comment->comment;
        $c->save();

        return redirect()->route('books.get', ['id' => $id]);
    }

    public function add_collections($id, Request $request){
        $cb = new CollectionBooks();
        $cb->adder_id = Auth::user()->id;
        $cb->collection_id = $request->id;
        $cb->book_id = $id;
        $cb->save();

        return redirect()->route('books.get', ['id' => $id]);
    }

}
