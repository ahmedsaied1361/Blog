<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
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

    public function store(PostRequest $request)
    {
        $imgsName = [];

        foreach ($request['imgs'] as $imgs) {

            $imgsName[] = Storage::putFile("Images", $imgs);
        }

        DB::transaction(function () use ($imgsName, $request) {
            $post = Post::create([
                "title" => $request['title'],
                "content" => $request['content'],
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
