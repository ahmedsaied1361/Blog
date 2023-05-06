<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use Auth;
use DB;
use Illuminate\Http\Request;
use Storage;

class CommentController extends Controller
{
    public function commentStore(Request $request, $id)
    {
        $data = $request->validate([
            "comment" => 'required|string|max:100',
            "img" => 'image|mimes:png,jpg,jpeg'
        ]);

        $data['img'] = Storage::putFile("Images", $data['img']);

        DB::transaction(function () use ($id, $data) {
            $comment = Comment::create([
                "content" => $data['comment'],
                "post_id" => $id,
                "user_id" => Auth::user()->id
            ]);
            $comment->image()->create([
                "imageable_id" => $comment['id'],
                "src" => $data['img']
            ]);
        });
        return redirect(url('posts'));
    }

    public function commentDelete($id)
    {
        DB::transaction(function () use ($id) {
            Comment::where('id', '=', $id)->delete();
            Image::where('imageable_id', '=', $id)->delete();
        });
        return redirect(url('posts'));
    }
}
