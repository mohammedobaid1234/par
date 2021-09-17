<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Tweet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
            'user_id' => 'required|exists:users,id',
            'tweet_id' => 'required|exists:tweets,id'
        ]);
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $image_url = $uploadedFile->store('/', 'upload');
            $request->merge([
                'image_url' => $image_url
            ]);
        }
        $comment = Comment::create($request->all());
        $tweet = Tweet::where('id', $request->tweet_id)->firstOrFail();
        $tweet->update([
            'comments' => $tweet->comments + 1
        ]);
        return new JsonResponse([
            'success' => 'the comment is addedd'
        ], 201);
    }
}
