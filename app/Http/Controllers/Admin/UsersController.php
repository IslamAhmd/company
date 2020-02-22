<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;

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
        $roles = Role::all();
        return view('admin.users.add-edit', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $rules = [

            'name' => 'required',
            'email' => 'required|email|unique:users',
            'pic' => 'image|mimes:png,jpg,jpeg',
            'password' => 'required',
            'role_id' => 'exists:roles,id'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->validate()){
            $this->authorize('create', User::class);
            if(! Auth::user()->isAdmin()){
                $request->request->add(['role_id' => Role::where(['name'=>'user'])->first() ? Role::where(['name'=>'user'])->first()->id : 0]);
            }
            else if (! $request->filled('role_id')){
                return redirect()->back()->withErrors(['role_id'=>__('validation.required', ['attribute'=>__('validation.attributes.role_id')])])->withInput();
            }
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

            return redirect(route('admin.users.index'))->withErrors(['success'=>__('admin.actions.add', ['attr'=>__('admin.general.user')])]);
        }

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
        return view('admin.users.add-edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $rules = [

            'name' => 'required',
            'email' => "required|email|unique:users,email,$id",
            'pic' => 'image|mimes:png,jpg,jpeg',
            'role_id' => 'exists:roles,id'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->validate()){
            $this->authorize('update', $user);

            $user->update($request->except(['password', 'role_id']));
            if($request->filled('role_id') && Auth::user()->isAdmin()){
                $user->role_id = $request->input('role_id');
            }
            if($request->filled('password')){
                $user->password = bcrypt($request->password);
            }
            if($request->hasFile('pic')){
                $path = public_path('/data/') . $user->pic;
                if(file_exists($path)) {
                    unlink($path);
                }
                $photo = $request->file('pic');
                $filename = time().'-'. $photo->getClientOriginalName();
                $location = public_path('data/'. $filename);
                Image::make($photo)->save($location);
                $user->pic = $filename;
            }
            $user->save();

            return redirect(route('admin.users.index'))->withErrors(['success'=> __('admin.actions.edit', ['attr'=>__('admin.general.user')])]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $this->authorize('delete', $user);
        $path = public_path('/data/') . $user->pic;
        if(file_exists($path)) {
            unlink($path);
        }
        $user->delete();

        return redirect(route('admin.users.index'))->withErrors(['success'=> __('admin.actions.delete', ['attr'=>__('admin.general.user')])]);

    }
}
