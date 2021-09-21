<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'report_id' => 'required|exists:reports,id',
        ]);
        
        $favorite_report = Favorite::create($request->all());
        return  response()->json([
            'status' => [
                'code' => 201,
                'status' => true,
                'message' => 'تم اضافة التقرير الى المفضلة'
            ],
            'data' => $favorite_report
        ],
         201); 
        
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
        $favorite_report = $user->load('favorites');

        return  response()->json([
            'status' => [
                'code' => 200,
                'status' => true,
                'message' => 'عرض التقارير المفضلة'
            ],
            'data' => $favorite_report->reports
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
        //
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
