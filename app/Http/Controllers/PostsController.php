<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function get($id){
        $post = Posts::findOrFail($id);
        return view('app.post', ['id' => $post->id, 'post' => $post]);
    }

    public function comment($id, Request $request){
        $c = new Comment();
        $c->model = "posts";
        $c->parent_id = $id;
        $c->user_id = Auth::user()->id;
        $c->body = $request->comment;
        $c->save();
        return redirect()->route('posts.get', ['id' => $id]);
    }

    public function comment_reply($id, $comment_id, Request $request){
        $c = new Comment();
        $c->model = "posts";
        $c->parent_id = $id;
        $c->reply_id = $comment_id;
        $c->user_id = Auth::user()->id;
        $c->body = $request->comment;
        $c->save();
        return redirect()->route('posts.get', ['id' => $id]);
    }
}
