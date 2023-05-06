<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Auth;
use DB;

class LikeController extends Controller
{
    public function likeIncrease($id)
    {
        $like = Like::where('user_id', '=', Auth::user()->id)->where('post_id', '=', $id);

        if (!$like->first()) {
            DB::transaction(function () use ($id) {
                Like::create([
                    "post_id" => $id,
                    "user_id" => Auth::user()->id
                ]);
                $post = Post::findOrFail($id);
                $post['likeCount'] = $post['likeCount'] + 1;
                $post->update(['likeCount' => $post['likeCount']]);
            });
        }

        return redirect(url('posts'));
    }

    public function likeDecrease($id)
    {
        $dislike = Like::where('user_id', '=', Auth::user()->id)->where('post_id', '=', $id);
        if ($dislike->first()) {
            DB::transaction(function () use ($id, $dislike) {
                $dislike->delete();
                $post = Post::findOrFail($id);
                $post['likeCount'] = $post['likeCount'] - 1;
                $post->update(['likeCount' => $post['likeCount']]);
            });
        }
        return redirect(url('posts'));
    }
}
