<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Council;
use App\Models\User;
use Illuminate\Http\Request;

class CouncilsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Council::whereNull('parent_id')->get(['name','id']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parent_council = Council::with('users','children')->find($id);
        if(!$parent_council){
            return response()->json([
                'message' => 'هذا المجلس غير موجود'
            ],401);
        }
        if($parent_council->children->count() > 0 ){
          
           $councils = $parent_council->load('children:id,name,parent_id');
           return $parent_council->children;
        }
        $council = $parent_council->load('children.users');
        $users = collect([]);
        $users1 = $council->users;
        foreach($users1 as $child){
            $id = $child->id;
            $name = $child->name;
            $array = [
                'id' => $id,
                'name' => $name
            ];
           
            $users->push($array);  
        }
        return $users;
    
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
