<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccessTokenController extends Controller
{
    public function checkUser(Request $request)
    {
        $request->validate([
            'phone_number' => 'required'
        ]);

        $user = User::where('phone_number', $request->phone_number)->first();
        if(!$user){
            return  response()->json(['message' => 'هذا الرقم غير موجود'],
             401); 
        }
        return $user;
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone_number' => ['required'],
            'password' => ['required'],
            'device_name' => ['required']
        ]);
        
        $user = User::where('phone_number', $request->phone_number)
        ->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return  response()->json(['message' => 'الرقم وكلمة المرور غير صحيحان '],
             401);
        }
        $token = $user->createToken($request->device_name);
            
            return  response()->json([
                'token' => $token->plainTextToken,
                'user' =>  $user
            ], 200);
    }
    public function destroy()
    {
        $user = Auth::guard('sanctum')->user();

        // Revoke (delete) all user tokens
        //$user->tokens()->delete();

        // Revoke current access token
        $user->currentAccessToken()->delete();
        return response()->json([
            'message' => 'تم تسجيل الخروج'
        ], 200);
    }

}
