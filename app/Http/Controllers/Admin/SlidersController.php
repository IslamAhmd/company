<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Validator;
class SlidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $type
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index($type)
    {
        $this->authorize('viewAny', Slider::class);

        $sliders = Slider::where(['type'=>$type])->paginate(40);
        return view('admin.sliders.index', compact('sliders', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $type
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create($type)
    {
        $this->authorize('create', Slider::class);
        return view('admin.sliders.add-edit', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $type
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store($type, Request $request)
    {
        $this->authorize('create', Slider::class);
        $rules = [
            'media.type' => 'required',
            'media.source' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->validate()){
            $src = $request->media['source'];
            $itype = $request->media['type'];
            if ($src == "upload" && $itype == 'image') {
                $rules = array_merge($rules, ['file' => 'required|image|mimes:png,jpg,jpeg']);
            }
            elseif ($src == "upload" && $itype == 'video') {
                $rules = array_merge($rules, ['file' => 'required|mimetypes:video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv']);
            }
            elseif ($src == 'link'){
                $rules = array_merge($rules, ['link' => 'required|string']);
            }
            $validator = Validator::make($request->all(), $rules);
            if($validator->validate()){
                $media = $request->media;
                if($request->media['source'] == 'upload'){
                    $file = $request->file('file');
                    $filename = time().'-'. $file->getClientOriginalName();
                    $location = public_path('data/');
                    $file->move($location,$filename );
                }
                $media['value'] = $request->media['source'] == 'upload' ?  $filename : $request->link;
                Slider::create(['type'=>$type, 'media'=>$media]);
                return redirect(route('admin.sliders.index', ['type'=>$type]))->withErrors(['success'=>__('admin.actions.add', ['attr'=>__('admin.sliders.slider')])]);

            }
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
     * @param $type
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($type, $id)
    {
        $slider = Slider::findOrFail($id);
        $this->authorize('update', $slider);
        return view('admin.sliders.add-edit', compact('type', 'slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $type
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update($type, Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $this->authorize('update', $slider);
        $rules = [
            'media.type' => 'required',
            'media.source' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->validate()){
            $src = $request->media['source'];
            $itype = $request->media['type'];
            if ($src == "upload" && $itype == 'image') {
                $rules = array_merge($rules, ['file' => 'image|mimes:png,jpg,jpeg']);
            }
            elseif ($src == "upload" && $itype == 'video') {
                $rules = array_merge($rules, ['file' => 'mimetypes:video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv']);
            }
            elseif ($src == 'link'){
                $rules = array_merge($rules, ['link' => 'required|string']);
            }
            $validator = Validator::make($request->all(), $rules);
            if($validator->validate()){
                $media = $request->media;
                if($request->media['source'] == 'upload'){
                    if ($request->hasFile('file')){
                        $path = public_path('/data/') . $slider->media['value'];
                        if(file_exists($path)) {
                            unlink($path);
                        }
                        $file = $request->file('file');
                        $filename = time().'-'. $file->getClientOriginalName();
                        $location = public_path('data/');
                        $file->move($location,$filename );
                    }
                }
                else {
                    $path = public_path('/data/') . $slider->media['value'];
                    if(file_exists($path)) {
                        unlink($path);
                    }
                }
                $media['value'] = $request->media['source'] == 'upload' ?  ($request->hasFile('file') ? $filename : $slider->media['value']) : $request->link;
                $slider->update(['media'=>$media]);
                return redirect(route('admin.sliders.index', ['type'=>$type]))->withErrors(['success'=>__('admin.actions.edit', ['attr'=>__('admin.sliders.slider')])]);

            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $type
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($type, $id)
    {
        $slider = Slider::where(['type'=>$type])->findOrFail($id);
        $this->authorize('delete', $slider);
        $path = public_path('/data/') . $slider->media['value'];
        if(file_exists($path)) {
            unlink($path);
        }
        $slider->delete();

        return redirect(route('admin.sliders.index', ['type'=>$type]))->withErrors(['success'=> __('admin.actions.delete', ['attr'=>__('admin.sliders.slider')])]);
    }
}
