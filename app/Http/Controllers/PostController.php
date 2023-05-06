<?php

namespace App\Http\Controllers;

use App\Models\Post;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function all()
    {
        $posts = Post::with('comments')->orderBy('created_at', 'desc')->paginate(2);

        return view('post.posts', ["posts" => $posts]);
    }

    public function storeForm()
    {
        return view('post.newPost');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "title" => 'required|string|max:20',
            "content" => 'required|string|max:20',
            "imgs.*" => 'image|mimes:png,jpg,jpeg'
        ]);

        $imgsName = [];

        foreach ($data['imgs'] as $imgs) {

            $imgsName[] = Storage::putFile("Images", $imgs);
        }

        DB::transaction(function () use ($imgsName, $data) {
            $post = Post::create([
                "title" => $data['title'],
                "content" => $data['content'],
                "user_id" => Auth::user()->id
            ]);
            foreach ($imgsName as $imgName) {
                $post->image()->create([
                    "imageable_id" => $post['id'],
                    "src" => $imgName
                ]);
            }
        });

        session()->flash("success", "Data Inserted Successfully");

        return redirect(url('posts'));
    }
}
