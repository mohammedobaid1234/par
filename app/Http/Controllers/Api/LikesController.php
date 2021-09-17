<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikesController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tweet_id' => 'required|exists:tweets,id',
        ]);
        $like = Like::where('user_id', $request->user_id)
            ->where('tweet_id', $request->tweet_id)
            ->first();
        if ($like) {
            DB::table('likes')->where('user_id', $request->user_id)
                ->where('tweet_id', $request->tweet_id)->delete();
            $tweet = Tweet::where('id', $request->tweet_id)->firstOrFail();
            $tweet->update([
                'likes' => $tweet->likes - 1
            ]);
            return ['success' => 'deleted'];
        } else {
            Like::create($request->all());
            $tweet = Tweet::where('id', $request->tweet_id)->firstOrFail();
            $tweet->update([
                'likes' => $tweet->likes + 1
            ]);
            return ['success' => 'created'];
        }
    }
}
