<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(40);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin.users.user', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [

            'name' => 'required',
            'email' => 'required|email|unique:users',
            'pic' => 'image|mimes:png,jpg,jpeg',
            'password' => 'required',
            'role_id' => 'required|exists:roles,id'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){

            return response()->json([
              "status" => "error",
              "errors" => $validator->errors()
            ]);
        }

        $this->authorize('create');

        $user = User::create($request->all());
        $user->password = bcrypt($request->password);
        if($request->hasFile('pic')){

            $photo = $request->file('pic');
            $filename = time().'-'. $photo->getClientOriginalName();
            $location = public_path('data/'. $filename);

            Image::make($photo)->save($location);
            $user->pic = $filename;
        }
        $user->save();

        return redirect()->back()->with('success', 'User Created Successfully');

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
        $roles = Role::get();
        $user = User::find($id);
        return view('admin.users.user', compact('roles', 'user'));
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
        $user = User::find($id);
        $rules = [

            'name' => 'required',
            'email' => "required|email|unique:users,email,$id",
            'pic' => 'image|mimes:png,jpg,jpeg',
            'password' => 'required',
            'role_id' => 'required|exists:roles,id'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){

            return response()->json([
              "status" => "error",
              "errors" => $validator->errors()
            ]);
        }

        $this->authorize('update', $user);

        $path = public_path('/data/') . $user->pic;
        unlink($path);

        $user->update($request->all());
        $user->password = bcrypt($request->password);
        if($request->hasFile('pic')){

            $photo = $request->file('pic');
            $filename = time().'-'. $photo->getClientOriginalName();
            $location = public_path('data/'. $filename);

            Image::make($photo)->save($location);
            $user->pic = $filename;
        }
        $user->save();

        return redirect()->back()->with('success', 'User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $this->authorize('delete', $user);

        $path = public_path('/data/') . $user->pic;
        unlink($path);

        $user->delete();

        return redirect()->back()->with('success', 'User Deleted Successfully');

    }
}
