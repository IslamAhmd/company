@extends('admin.layouts.master')
@section('head')
    <title>{{__('admin.headers.title')}} - {{__('admin.general.list')}} {{__('admin.headers.title')}}</title>
    @include('admin.partials.datatable_styles')
@endsection
@section('content')
    <div class="">
        <div class="page-header-title"><h4 class="page-title">{{__('admin.headers.title')}}</h4></div>
    </div>
    <div class="page-content-wrapper ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <h4 class="m-b-30 m-t-0">@if(isset($header)){{__('admin.general.edit')}} @else {{__('admin.general.add')}} @endif {{__('admin.headers.title')}}</h4>
                            <form class="form-horizontal" role="form"
                                  action="@if(isset($header)){{ route('admin.headers.update', ['slider'=>$header->id, 'type'=>$type]) }} @else {{  route('admin.headers.store', ['type'=>$type]) }} @endif"
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                @isset($header)
                                    @method('put')
                                @endisset
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{{__('admin.general.the_text')}} :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('phone') parsley-error @enderror"
                                               name="text"
                                               placeholder="{{__('admin.general.enter')}} {{__('admin.general.the_text')}}"
                                               value="{{old('text') ? old('text') : (isset($header)? $header->text: null)}}">
                                        @error('text')
                                        <span class="help-block text-danger"><small>{{$message}}.</small></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{{__('admin.general.lang')}} </label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('lang') parsley-error @enderror"
                                                name="lang">
                                            <option value="ar"
                                                    @if(old('lang')) @if(old('lang') == 'ar') selected="selected" @endif
                                                    @elseif(isset($header))
                                                    @if($header->lang == 'ar')
                                                    selected="selected" @endif
                                                    @else selected="selected" @endif>
                                            {{ __('admin.general.ar') }}</option>

                                            <option value="en" @if(old('lang')) @if(old('lang') == 'en') selected="selected" @endif
                                            @elseif(isset($header))
                                            @if($header->lang == 'en')
                                            selected="selected" @endif
                                                     @endif>{{ __('admin.general.en') }}</option>
                                        </select>
                                        @error('lang')
                                        <span class="help-block text-danger"><small>{{$message}}.</small></span>
                                        @enderror
                                    </div>
                                </div>
                                @if($type != 0)
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{{__('admin.general.the_link')}} :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('phone') parsley-error @enderror"
                                               name="link"
                                               placeholder="{{__('admin.general.enter')}} {{__('admin.general.the_link')}}"
                                               value="{{old('link') ? old('link') : (isset($header)? $header->link: null)}}">
                                        @error('link')
                                        <span class="help-block text-danger"><small>{{$message}}.</small></span>
                                        @enderror
                                    </div>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{{__('admin.general.pic')}} : </label>
                                    <div class="col-sm-10">
                                        <input name="pic" type="file" class="form-control @error('pic') parsley-error @enderror"
                                               value="{{old('pic') ? old('pic') : (isset($header)? $header->pic: null)}}">
                                        <br>
                                       @isset($header) <img height="100" src="{{asset('data/'.$header->pic)}}"> @endisset

                                        @error('pic')
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
    @include('admin.partials.datatable_scripts')


@endsection