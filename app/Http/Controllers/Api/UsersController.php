<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if(!$user){
            return  response()->json([
                'status' => [
                    'code' => 404,
                    'status' => true,
                    'message' => 'هذا العضو غير موجود'
                ],
                'data' => null
            ],
             404);
        }
        $user =  $user->load('tweets');
        return  response()->json([
            'status' => [
                'code' => 200,
                'status' => true,
                'message' => 'عرض بيانات المستخدم'
            ],
            'data' => $user
        ],
         200); 

        
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
        $user = User::findOrFail($id);
        if(!$user) {
            return  response()->json([
                'status' => [
                    'code' => 404,
                    'status' => true,
                    'message' => 'هذا العضو غير موجود'
                ],
                'data' => null
            ],
             404);
        }
        $request->validate([
            'name' => 'sometimes|required|min:3|unique:users,name,'. $id,
            'image' => 'nullable',
            'about' => 'nullable'
        ]);

        if($request->hasFile('image')){
            if($user->image_url !== null){

                unlink(public_path('uploads/' . $user->image_url));
            }
            $uploadedFile = $request->file('image');
            $image_url = $uploadedFile->store('/','upload');
            $request->merge([
                'image_url' => $image_url
            ]);
        }
       
        $user->update($request->all());
        return  response()->json([
            'status' => [
                'code' => 200,
                'status' => true,
                'message' => 'تم تعديل بيانات العضو'
            ],
            'data' => $user
        ],
         200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
