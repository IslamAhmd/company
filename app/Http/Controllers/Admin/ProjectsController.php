<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use File;
use Illuminate\Support\Facades\Auth;
use Validator;
use Image;
use App\Models\User;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $projects = Project::with('user')->paginate(40);

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
            'media.*' => 'mimes:jpeg,png,jpg,gif,svg,mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040',
            'article_media.*' => 'mimes:jpeg,png,jpg,gif,svg,mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040',

        ];


        $validator = Validator::make($request->all(), $rules);


        if($validator->validate()){
            $this->authorize('create', User::class);

            File::makeDirectory(public_path('/data/') . $request->name);


            $medias = [];
            if($files = $request->file('media')){

                foreach ($files as $file) {

                    $name = time() . '-' . $file->getClientOriginalName();
                    $file->move(public_path() . '/data/' . $request->name . '/', $name);
                    array_push($medias, $name);

                    
                }

            }

            $articles_media = [];
            if($files = $request->file('article_media')){

                foreach ($files as $file) {

                    $name = time() . '-' . $file->getClientOriginalName();
                    $file->move(public_path() . '/data/' . $request->name . '/', $name);
                    array_push($articles_media, $name);

                    
                }

            }

            $project = Project::create($request->except(['media', 'article_media']));
            $project->user_id = Auth::id();
            $project->media = implode('|', $medias);
            $project->article_media = implode('|', $articles_media);
            if($request->hasFile('logo')){
                $photo = $request->file('logo');
                $filename = time().'-'. $photo->getClientOriginalName();
                $location = public_path('data/'. $project->name . '/' . $filename);
                Image::make($photo)->save($location);
                $project->logo = $filename;
            }            

            $project->save();

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
        $project = Project::find($id);

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
            'media.*' => 'mimes:jpeg,png,jpg,gif,svg,mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040',
            'article_media.*' => 'mimes:jpeg,png,jpg,gif,svg,mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040',

        ];


        $validator = Validator::make($request->all(), $rules);

        $this->authorize('update', $project->user);

        if($validator->validate()){
            $oldName = $project->name;
            if(file_exists(public_path('/data/' . $oldName))){

                File::move(public_path('/data/' . $oldName), public_path('/data/' . $request->name));

            }


            $medias = [];
            if($files = $request->file('media')){

                foreach ($files as $file) {

                    $name = time() . '-' . $file->getClientOriginalName();
                    $file->move(public_path() . '/data/' . $request->name . '/', $name);
                    array_push($medias, $name);

                    
                }

            }

            $articles_media = [];
            if($files = $request->file('article_media')){

                foreach ($files as $file) {

                    $name = time() . '-' . $file->getClientOriginalName();
                    $file->move(public_path() . '/data/' . $request->name . '/', $name);
                    array_push($articles_media, $name);

                    
                }

            }

            $project->update($request->except(['media', 'article_media']));
            $project->user_id = Auth::id();
            $project->media = implode('|', $medias);
            $project->article_media = implode('|', $articles_media);
            if($request->hasFile('logo')){
                $photo = $request->file('logo');
                $filename = time().'-'. $photo->getClientOriginalName();
                $location = public_path('data/'. $project->name . '/' . $filename);
                Image::make($photo)->save($location);
                $project->logo = $filename;
            }            

            $project->save();

            return redirect(route('admin.projects.index'))->withErrors(['success'=>__('admin.actions.edit', ['attr'=>__('admin.general.project')])]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        $this->authorize('update', $project->user);

        File::deleteDirectory(public_path('/data/' . $project->name));

        $project->delete();

        return redirect(route('admin.projects.index'))->withErrors(['success'=> __('admin.actions.delete', ['attr'=>__('admin.general.project')])]);

    }
}
