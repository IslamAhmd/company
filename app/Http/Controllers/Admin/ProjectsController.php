<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use File;
use Illuminate\Support\Facades\Auth;
use Validator;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(40);

        return view('admin.projects.index', compact('projects'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.add-edit');
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
            'logo' => 'required|image|mimes:png,jpg,jpeg',
            'title' => 'required',
            'body' => 'required',
            'article_title' => 'required',
            'article_body' => 'required',
            'service_body' => 'required',
            'show_link' => 'Boolean',
            'message' => 'required',
            'lang' => 'required',
            'ends_at' => 'required'

        ];


        $validator = Validator::make($request->all(), $rules);

        if($validator->validate()){
            $this->authorize('create', Project::class);
            
            $project = Project::create($request->all());
            $project->user_id = Auth::id();
            File::makeDirectory(public_path('/data/') . $project->name);
            if($request->hasFile('logo')){
                $photo = $request->file('logo');
                $filename = time().'-'. $photo->getClientOriginalName();
                $location = public_path('data/'. $filename);
                Image::make($photo)->save($location);
                $project->logo = $filename;
            }
            $user->save();

            return redirect(route('admin.projects.index'))->withErrors(['success'=>__('admin.actions.add', ['attr'=>__('admin.general.project')])]);
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);

        return view('admin.projects.add-edit', compact('project'));
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
