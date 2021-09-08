<?php

namespace App\Http\Controllers;

use App\Models\Council;
use Illuminate\Http\Request;

class SectionsController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSection($id) // for create circles
    {   
        $council = Council::whereNull('parent_id')->findOrFail($id);
       
        // return $councils;
        if($council->id == 3 || $council->id == 5){
            return redirect()->route('home.index');
        }
        return view('admin.sections.create-section', [
          
            'title' => "اضافة $council->type",
            'type' => $council->type,
            'id' => $id
           
        ]);
    }
    public function sectionStore(Request $request,$id)
    {
        $request->validate([
            'name' => ['required']
        ]);
        $request->merge(['parent_id' => $id]);
        Council::create($request->all());
        return redirect()->back();
    }
    public function beforeCreate()
    {   
        $councils = Council::whereNull('parent_id')
        ->where('name','<>',3)
        ->Where('id','<>',5) 
        ->pluck('name','id');
        return view('admin.sections.before-create',[
            'councils' => $councils,
            
        ]);   
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $section = Council::findOrFail($id);
        $type = $section->load('parent');
        $type = $type->parent->type ;
        return view('admin.sections.edit',[
            'section' => $section ,
            'title' => " تعديل ال$type",
            'type' => "ال".$type   
        ]);
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
