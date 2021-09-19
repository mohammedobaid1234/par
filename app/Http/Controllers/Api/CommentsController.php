<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Tweet;
use App\Models\User;
use App\Notifications\CommentCreatedNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['show', 'index']);
    }
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
        $user = User::findOrFail($request->post('user_id'));
        $user->notify(new CommentCreatedNotification($comment));
        return new JsonResponse([
            'success' => 'هذا التعليق تمت اضافته',
            'comment' => $comment->load('user'),
        ], 201);
    }
}
