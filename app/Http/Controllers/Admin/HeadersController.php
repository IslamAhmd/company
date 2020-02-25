<?php

namespace App\Http\Controllers\Admin;

use App\Models\Header;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Intervention\Image\Facades\Image;
use Validator;
class HeadersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index($type)
    {
        $this->authorize('viewAny', Header::class);

        $headers = Header::where(['type'=>$type])->paginate(40);
        return view('admin.headers.index', compact('headers', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create($type)
    {
        $this->authorize('create', Header::class);
        return view('admin.headers.add-edit', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store($type, Request $request)
    {
        $this->authorize('create', Header::class);
        $rules = [
            'text' => 'required',
            'lang' => 'required',
            'pic' => 'required|image|mimes:png,jpg,jpeg',
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->validate()){
            $photo = $request->file('pic');
            $filename = time().'-'. $photo->getClientOriginalName();
            $location = public_path('data/'. $filename);
            Image::make($photo)->save($location);
            $header = Header::create(array_merge($request->except('pic'), ['type'=> $type, 'pic'=>$filename]));

            return redirect(route('admin.headers.index', ['type'=>$type]))->withErrors(['success'=>__('admin.actions.add', ['attr'=>__('admin.headers.header')])]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $type
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($type, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($type, $id)
    {
        $header = Header::findOrFail($id);
        $this->authorize('update', $header);
        return view('admin.headers.add-edit', compact('type', 'header'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update($type, Request $request, $id)
    {
        $header = Header::findOrFail($id);
        $this->authorize('update', $header);
        $rules = [
            'text' => 'required',
            'lang' => 'required',
            'pic' => 'image|mimes:png,jpg,jpeg',
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->validate()){
            if ($request->hasFile('pic')){
                $path = public_path('/data/') . $header->pic;
                if(file_exists($path)) {
                    unlink($path);
                }
                $photo = $request->file('pic');
                $filename = time().'-'. $photo->getClientOriginalName();
                $location = public_path('data/'. $filename);
                Image::make($photo)->save($location);
            }
            else {
                $filename = $header->pic;
            }
            $header->update(array_merge($request->except('pic'), ['type'=> $type, 'pic'=>$filename]));

            return redirect(route('admin.headers.index', ['type'=>$type]))->withErrors(['success'=>__('admin.actions.edit', ['attr'=>__('admin.headers.header')])]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($type, $id)
    {
        $header = Header::find($id);
        $this->authorize('delete', $header);
        $path = public_path('/data/') . $header->pic;
        if(file_exists($path)) {
            unlink($path);
        }
        $header->delete();

        return redirect(route('admin.headers.index', ['type'=>$type]))->withErrors(['success'=> __('admin.actions.delete', ['attr'=>__('admin.headers.header')])]);
    }
}
