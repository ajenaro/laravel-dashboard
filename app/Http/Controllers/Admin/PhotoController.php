<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function store(Post $post)
    {
        $this->validate(
            request(),
            [
                'photo' => 'required|image|max:2048'
            ]
        );

        $post->photos()->create(['url' => request()->file('photo')->store('posts', 'public')]);
    }

    public function destroy(Photo $photo)
    {
        $photo->delete();

        return back()->with('flash', 'Foto eliminada correctamente');
    }

    public function update(Request $request, $id)
    {
        $photos = Photo::where('post_id', $request->post_id)->get();

        foreach ($photos as $photo) {

            if($photo->id === (int) $id) {
                $photo->featured = $request->checked;
            } else {
                $photo->featured = 0;
            }

            $photo->save();
        }

        return response()->json(['res' => true, 'photo_id' => $id, 'checked_from_server' => $request->checked]);
    }
}
