<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClubController extends Controller
{
    public function index(){
        $clubs = Club::paginate(15);

        return view('app.clubs.all', [
            'clubs' => $clubs
        ]);
    }

    public function get($id){
        $club = Club::find($id);

        return view('app.clubs.get', [
            'club' => $club
        ]);
    }

    public function create(Request $request){
        $c = new Club();

        if ($request->thumbnail) {
            $thumbnail = $request->file('thumbnail');
            $c->thumbnail = json_encode("data:image/jpeg;base64,".base64_encode(file_get_contents($thumbnail->getRealPath())));
        };

        $c->title = $request->title;
        $c->description = $request->description;
        $c->type = $request->type;
        $c->owner_id = Auth::user()->id;
        $c->moderators = json_encode([Auth::user()->id]);

        $c->save();

        return redirect()->route('clubs.get', ['id' => $c->id]);
    }

    public function search(Request $request){
        $query = Club::query();

        if ($request->title) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->type) {
            $query->where('type', '=', $request->type);
        }

        $clubs = $query->paginate(12);

        return view('app.clubs.all', [
            'clubs' => $clubs
        ]);
    }

    public function post_publish($id, Request $request){
        $p = new Posts();
        $images = $request->file('images');
        $imagesBase64 = [];

        if ($images) {
            foreach ($images as $image) {
                $imageData = file_get_contents($image->getPathname());
                $base64 = 'data:' . $image->getMimeType() . ';base64,' . base64_encode($imageData);
                $imagesBase64[] = $base64;
            }
            $p->assets = json_encode(['imgs' => $imagesBase64]);
        }

        $p->club_id = $id;
        $p->user_id = Auth::user()->id;
        $p->body = $request->body;

        $p->save();
        return back();
    }
}
