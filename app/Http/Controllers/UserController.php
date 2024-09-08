<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile(){
        $user = User::find(Auth::user()->id);
        return view('app.users.profile', [
            'user' => $user
        ]);
    }

    public function my_collections($id = null){
        if ($id != null) {
            $c = Collection::find($id);
        } else {
            $c = Collection::where('user_id', Auth::user()->id)->first();
        };

        return view('app.users.my_collections', ['c' => $c]);
    }

    public function collection_create(Request $collection){
        $c = new Collection();
        $c->user_id = Auth::user()->id;
        $c->title = $collection->title;
        $c->save();

        return redirect()->route('users.profile.my_collections');
    }

    public function pwd_upd(Request $request){
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'confirmed', 'min:8'],
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Текущий пароль неверен.']);
        }
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Пароль успешно обновлен!');
    }

    public function post_publish(Request $request){
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

        $p->user_id = Auth::user()->id;
        $p->body = $request->body;

        $p->save();
        return back();
    }

    public function a_upd(Request $request){
        $image = $request->file('avatar');
        $imageData = file_get_contents($image->getPathname());
        $base64 = 'data:' . $image->getMimeType() . ';base64,' . base64_encode($imageData);

        $u = User::find(Auth::user()->id);
        $u->avatar = $base64;
        $u->save();

        return back();
    }
}
