<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Council;
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
        $councils = Council::all();
        return view('admin.councils.index', [
            'councils' => $councils
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() // for create councils
    {
        // $councils = Council::whereNull('parent_id')
        //     ->pluck('name', 'id');
        return view('admin.councils.create-council');
    }

    public function children($id)
    {
        // return $id;
        $council = Council::findOrFail($id);
        return $council->children;
        // if($council->children->count())
    }
    public function createCircle() // for create circles
    {
        $councils = Council::whereNull('parent_id')
            ->pluck('name', 'id');
        // return $councils;
        return view('admin.councils.create-circle', [
            'councils' => $councils,
            'title' => 'اضافة دائرة'
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
        $request->validate([
            'name' => 'required|string|min:5'
        ]);
        $council =  Council::create($request->all());
        if ($request->post('parent_id')) {
            $messege =  'تم اضافة دائرة جديد';
        } else {
            $messege =  'تم اضافة مجلس جديد';
        }
        return redirect(route('councils.index'))->with('success', $messege);
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
        //
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
        
    }
}
