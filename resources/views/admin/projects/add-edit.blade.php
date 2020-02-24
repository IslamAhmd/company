@extends('admin.layouts.master')
@section('head')
    <title>{{__('admin.general.add')}} {{__('admin.general.project')}}</title>
    <link href="{{asset('admin/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('admin/plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/datatables/fixedHeader.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/datatables/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    
@endsection
@section('content')
    <div class="">
        <div class="page-header-title"><h4 class="page-title">{{__('admin.general.projects')}}</h4></div>
    </div>
    <div class="page-content-wrapper ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <h4 class="m-b-30 m-t-0">{{__('admin.general.add')}} {{__('admin.general.projects')}}</h4>

                            <form class="form-horizontal" role="form"
                                  action="@if(isset($project)){{ route('admin.projects.update', $project->id) }} @else {{  route('admin.projects.store') }} @endif"
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                @isset($project)
                                    @method('put')
                                @endisset
                                <div class="form-group">
                                    <label class="col-md-2 control-label">{{__('admin.general.name')}} </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control @error('name') parsley-error @enderror"
                                               placeholder="{{__('admin.general.enter')}} {{__('admin.general.name')}}" name="name"
                                               value="{{isset($project->id)? $project->name : null}}">
                                        @error('name')
                                        <span class="help-block text-danger"><small>{{$message}}.</small></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="title">{{__('admin.general.title')}} </label>
                                    <div class="col-md-10">
                                        <input type="text" id="title"
                                               name="title" class="form-control @error('title') parsley-error @enderror"
                                               placeholder="{{__('admin.general.enter')}} {{__('admin.general.title')}}"
                                               value="{{isset($project->id)? $project->title : null}}">
                                        @error('title')
                                        <span class="help-block text-danger"><small>{{$message}}.</small></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">{{__('admin.general.body')}} </label>
                                    <div class="col-md-10">
                                        <textarea type="text" class="form-control @error('body') parsley-error @enderror"
                                               placeholder="{{__('admin.general.enter')}} {{__('admin.general.body')}}"
                                               name="body"
                                               value="{{isset($project)? $project->body : null}}"></textarea>
                                        @error('body')
                                        <span class="help-block text-danger"><small>{{$message}}.</small></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{{__('admin.general.article_title')}} </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('article_title') parsley-error @enderror"
                                               name="article_title"
                                               placeholder="{{__('admin.general.enter')}} {{__('admin.general.article_title')}}"
                                               value="{{isset($project)? $project->article_title : null}}">
                                        @error('article_title')
                                        <span class="help-block text-danger"><small>{{$message}}.</small></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{{__('admin.general.article_body')}} </label>
                                    <div class="col-sm-10">
                                        <textarea type="text" class="form-control @error('article_body') parsley-error @enderror"
                                               name="article_body"
                                               placeholder="{{__('admin.general.enter')}} {{__('admin.general.article_body')}}"
                                               value="{{isset($project)? $project->article_body : null}}"></textarea>
                                        @error('article_body')
                                        <span class="help-block text-danger"><small>{{$message}}.</small></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{{__('admin.general.service_body')}} </label>
                                    <div class="col-sm-10">
                                        <textarea type="text" class="form-control @error('service_body') parsley-error @enderror"
                                               name="service_body"
                                               placeholder="{{__('admin.general.enter')}} {{__('admin.general.service_body')}}"
                                               value="{{isset($project)? $project->service_body : null}}"></textarea>
                                        @error('service_body')
                                        <span class="help-block text-danger"><small>{{$message}}.</small></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{{__('admin.general.status')}} </label>
                                    <div class="col-sm-10">
                                        <input type="number" max="3" min="0" class="form-control @error('status') parsley-error @enderror"
                                               name="status"
                                               placeholder="{{__('admin.general.enter')}} {{__('admin.general.status')}}"
                                               value="{{isset($project)? $project->status : null}}">
                                        @error('status')
                                        <span class="help-block text-danger"><small>{{$message}}.</small></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{{__('admin.general.show_link')}} </label>
                                    <div class="col-sm-1">
                                        <input type="checkbox" class="form-control @error('show_link') parsley-error @enderror"
                                               name="show_link"                                       
                                               value="{{isset($project)? $project->show_link : 0}}">
                                        @error('show_link')
                                        <span class="help-block text-danger"><small>{{$message}}.</small></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{{__('admin.general.message')}} </label>
                                    <div class="col-sm-10">
                                        <textarea type="text" class="form-control @error('message') parsley-error @enderror"
                                               name="message"
                                               placeholder="{{__('admin.general.enter')}} {{__('admin.general.message')}}"
                                               value="{{isset($project)? $project->message : null}}"></textarea>
                                        @error('message')
                                        <span class="help-block text-danger"><small>{{$message}}.</small></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{{__('admin.general.lang')}} </label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('lang') parsley-error @enderror"
                                               name="lang">
                                                   <option value="{{isset($project)? $project->lang : null}}">{{ __('admin.general.ar) }}</option>

                                                   <option value="{{isset($project)? $project->lang : null}}">{{ __('admin.general.en) }}</option>
                                        </select>
                                        @error('lang')
                                        <span class="help-block text-danger"><small>{{$message}}.</small></span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{{__('admin.general.logo')}} </label>
                                    <div class="col-sm-10">
                                        <input name="logo" type="file" class="form-control @error('logo') parsley-error @enderror"
                                               value="{{isset($project->id)? $project->logo : null}}">
                                        @error('logo')
                                        <span class="help-block text-danger"><small>{{$message}}.</small></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary">{{__('admin.general.submit')}}</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables/responsive.bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables/dataTables.scroller.min.js')}}"></script>
    <script src="{{asset('admin/pages/datatables.init.js')}}"></script>
@endsection