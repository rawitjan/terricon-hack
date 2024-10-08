<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Game;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $games = Game::where('ended', '>=', $startOfWeek)
            ->where('ended', '<=', $endOfWeek)
            ->whereNotNull('score')
            ->get();

        $leaderboard = $games->groupBy('user_id')
            ->map(function ($games) {
                return $games->sum('score');
            })
            ->sortDesc()
            ->take(10);
        $top_users = $leaderboard->keys();

        $users = User::whereIn('id', $top_users)->get();
        return view('game.index', [
            'leaderboard' => $leaderboard,
            'users' => $users
        ]);
    }
    public function create(Request $request, $gameType)
    {
        $books = Books::inRandomOrder()->limit(5)->get();

        $questions = $books->map(function ($book) use ($gameType) {
            $options = Books::where('id', '!=', $book->id)
                ->inRandomOrder()
                ->limit(3)
                ->get(['id', 'title'])
                ->toArray();

            $correctOption = [
                'id' => $book->id,
                'title' => $book->title,
            ];
            $options[] = $correctOption;

            shuffle($options);

            if ($gameType === 'find_by_description') {
                return [
                    'question' => $book->description,
                    'answer' => $book->id,
                    'options' => $options
                ];
            } elseif ($gameType === 'find_by_thumbnail') {
                return [
                    'question' => $book->thumbnail,
                    'answer' => $book->id,
                    'options' => $options
                ];
            }
        });


        $game = new Game();
        $game->user_id = Auth::user()->id;
        $game->game_type = $gameType;
        $game->started = now();
        $game->data = $questions->toJson();
        $game->save();

        return view('game.play', compact('game'));
    }

    public function submit(Request $request, Game $game)
    {
        $answers = json_decode($request->input('answers'), true);
        $correctAnswers = 0;

        foreach (json_decode($game->data, true) as $index => $question) {
            if ($answers[$index] == $question['answer']) {
                $correctAnswers += 1;
            }
        }

        $game->ended = now();
        $game->score = $correctAnswers;
        $game->save();

        return redirect()->route('game.result', $game);
    }

    public function result(Game $game)
    {
        return view('game.result', compact('game'));
    }
}
