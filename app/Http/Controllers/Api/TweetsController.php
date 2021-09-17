<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TweetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        dd( $request->header('User-Agent'));
        $tweets = Tweet::with('user:id,name,type')->paginate(3);
        return new JsonResponse($tweets);
    }
    // PostmanRuntime/7.28.4

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
            'user_id' => 'required|exists:users,id',
            'image' => 'nullable'
        ]);
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $image_url = $uploadedFile->store('/', 'upload');
            $request->merge([
                'image_url' => $image_url
            ]);
        }
        $tweet = Tweet::create($request->all());
        return new JsonResponse($tweet->load('user:name,id'), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tweet = Tweet::with('user')->findOrFail($id);
        return new JsonResponse($tweet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tweet = Tweet::findOrFail($id);
        $request->validate([
            'body' => 'sometimes|required|unique',
            'user_id' => 'nullable|exists:users,id',
            'image' => 'nullable'
        ]);
        if ($request->hasFile('image')) {
            unlink(public_path('uploads/' . $tweet->image_url));
            $uploadedFile = $request->file('image');
            $image_url = $uploadedFile->store('/', 'upload');
            $request->merge([
                'image_url' => $image_url
            ]);
        }
        $tweet->update($request->all());
        return new JsonResponse([
            $tweet
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tweet = Tweet::findOrFail($id);
        $tweet->delete();
        return new JsonResponse([
            'message' => 'the tweet is deleted'
        ]);
    }
}
