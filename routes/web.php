<?php

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware(['sl'])->group(function () {
    Route::get('/', function () { if(Auth::check()){ return redirect()->route('home'); } else { return redirect()->route('welcome'); } });
    Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome')->middleware('sl');
    Auth::routes();

    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('sl');

        Route::get('/game', [App\Http\Controllers\GameController::class, 'index'])->name('game');
        Route::get('/game/{gameType}/create', [App\Http\Controllers\GameController::class, 'create'])->name('game.create');
        Route::post('/game/{game}/submit', [App\Http\Controllers\GameController::class, 'submit'])->name('game.submit');
        Route::get('/game/{game}/result', [App\Http\Controllers\GameController::class, 'result'])->name('game.result');

        Route::prefix('reader')->name('users.')->group(function () {
            Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
            Route::post('/profile/avatar/update', [App\Http\Controllers\UserController::class, 'a_upd'])->name('profile.a_upd');
            Route::post('/profile/password/update', [App\Http\Controllers\UserController::class, 'pwd_upd'])->name('profile.pwd_upd');
            Route::get('/profile/my_collections', [App\Http\Controllers\UserController::class, 'my_collections'])->name('profile.my_collections');
            Route::get('/profile/my_collections/{id}', [App\Http\Controllers\UserController::class, 'my_collections'])->name('profile.my_collections.v');
            Route::post('/profile/my_collections', [App\Http\Controllers\UserController::class, 'collection_create'])->name('profile.collection.create');
        });

        Route::prefix('posts')->name('posts.')->group(function () {
            Route::get('/{id}', [App\Http\Controllers\PostsController::class, 'get'])->name('get');
            Route::post('/publish', [App\Http\Controllers\UserController::class, 'post_publish'])->name('publish');
            Route::post('/{id}', [App\Http\Controllers\PostsController::class, 'comment'])->name('comment');
            Route::post('/{id}/{comment_id}/reply', [App\Http\Controllers\PostsController::class, 'comment_reply'])->name('comment.reply');
        });

        Route::prefix('clubs')->name('clubs.')->group(function () {
            Route::get('/', [App\Http\Controllers\ClubController::class, 'index'])->name('all');
            Route::get('/search', [App\Http\Controllers\ClubController::class, 'search'])->name('search');
            Route::post('/create', [App\Http\Controllers\ClubController::class, 'create'])->name('create');
            Route::get('/{id}', [App\Http\Controllers\ClubController::class, 'get'])->name('get');
            Route::post('/{id}/publish', [App\Http\Controllers\ClubController::class, 'post_publish'])->name('post.publish');
        });

        Route::prefix('books')->name('books.')->group(function () {
            Route::get('/', [App\Http\Controllers\BooksController::class, 'index'])->name('all');
            Route::get('/search', [App\Http\Controllers\BooksController::class, 'search'])->name('search');

            Route::get('/exchange', [App\Http\Controllers\BooksController::class, 'exchange_list'])->name('exchange');
            Route::post('/exchange', [App\Http\Controllers\BooksController::class, 'exchange_publish'])->name('exchange.publish');

            Route::get('/{id}', [App\Http\Controllers\BooksController::class, 'get'])->name('get');
            Route::post('/{id}/add_collections', [App\Http\Controllers\BooksController::class, 'add_collections'])->name('add_collections');
            Route::post('/{id}/comment', [App\Http\Controllers\BooksController::class, 'comment'])->name('comment');
        });
    });

});


Route::get('language/{language}', function ($language) { Session()->put('locale', $language); return redirect()->back(); })->name('language');
