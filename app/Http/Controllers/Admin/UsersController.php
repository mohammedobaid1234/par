<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Council;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', [
            'users' => $users,
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
       
        $council = Council::findOrFail($id);
        // if($council->type == 'عضو مجلس'){
        //     $selectLab = 'الدائرة';
        // }elseif($council->type == 'جمعية'){
        //     $selectLab = 'المحافظة';  
        // }
        $children = $council->load('children');
        $children = $children->children->pluck('name', 'id');
        
        return view('admin.users.create', [
            'children' => $children,
            'name' => $council->name,
            // 'selectLab' => $selectLab,
            'type' => $council->type
        ]);
        // $councils = Council::whereNull('parent_id')->pluck('name' , 'id');
        // // return $councils;
        // // $array = [];
        // // $userTypes = Council::get();
        // // foreach ($userTypes as $user) {
        // //     if ($user->children->count() == 0) {
        // //        if($user->parent_id == 0){
            // //             $array[$user->id] = $user->name;
        // //        }else{
            // //            $counciel_name = $user->parent->name; 
            // //             $array[$user->id] = $user->name. "[$counciel_name]";
            // //        }
            // //     }
                        // // }
            
            // return view('admin.users.create',[
                //     'councils' => $councils
                // ]);
    }
    public function beforeCreate()
    {
        
        $councils = Council::whereNull('parent_id')->pluck('name','id');
        return view('admin.users.before-create',[
            'councils' => $councils,
            'title' =>'dd'
            
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
            'name' => 'required|min:8',
            'phone_number' => 'required',
            'about' => 'nullable|min:8',
            'image' => 'nullable|image',
            'full_name' => 'nullable|min:10',
            'birthday' => 'nullable|date',
            'type' => 'required',
            'marital_status' => 'required',
            'email' => 'nullable|email',
            'password' => 'required'
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_url = $image->store('/', 'upload');
            $request->merge([
                'image_url' => $image_url
            ]);
        }
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
        $user = User::create(
            $request->all()
        );
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', [
            'user' => $user
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
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|min:8',
            'phone_number' => 'required',
            'about' => 'nullable|min:8',
            'image' => 'nullable|image',
            'full_name' => 'nullable|min:10',
            'birthday' => 'nullable|date',
            'type' => 'required',
            'marital_status' => 'required',
            'email' => 'nullable|email',
            'password' => 'required'
        ]);
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
        $user->update($request->all());
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect(route('users.index'))->with('success', 'تم حذف العضو');
    }
}
