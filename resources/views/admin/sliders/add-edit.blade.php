@extends('admin.layouts.master')
@section('head')
    <title>{{__('admin.sliders.title')}} - {{__('admin.general.list')}} {{__('admin.sliders.title')}}</title>
    @include('admin.partials.datatable_styles')
@endsection
@section('content')
    <div class="">
        <div class="page-header-title"><h4 class="page-title">{{__('admin.sliders.title')}}</h4></div>
    </div>
    <div class="page-content-wrapper ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <h4 class="m-b-30 m-t-0">@if(isset($slider)){{__('admin.general.edit')}} @else {{__('admin.general.add')}} @endif {{__('admin.sliders.title')}}</h4>
                            <form class="form-horizontal" role="form"
                                  action="@if(isset($slider)){{ route('admin.sliders.update', ['slider'=>$slider->id, 'type'=>$type]) }} @else {{  route('admin.sliders.store', ['type'=>$type]) }} @endif"
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                @isset($slider)
                                    @method('put')
                                @endisset
                                <div class="form-group">
                                    <label class="col-md-2 control-label">{{__('admin.sliders.type')}} : </label>
                                    <div class="col-md-10">
                                        <div class="radio radio-info radio-inline"><input type="radio"
                                                                                          id="inlineRadio1"
                                                                                          value="image"
                                                                                          name="media[type]"
                                                                                          @if(old('media.type')) @if(old('media.type') == 'image') checked="checked" @endif
                                                                                          @elseif(isset($slider))
                                                                                          @if($slider->media['type'] == 'image')
                                                                                          checked="checked" @endif
                                                                                          @else checked="checked" @endif >
                                            <label for="inlineRadio1"> {{__('admin.general.image')}} </label></div>
                                        <div class="radio radio-info radio-inline"><input type="radio" id="inlineRadio4"
                                                                                          value="video"
                                                                                          name="media[type]"
                                                                                          @if(old('media.type')) @if(old('media.type') == 'video') checked="checked" @endif
                                                                                          @elseif(isset($slider))
                                                                                          @if($slider->media['type'] == 'video')
                                                                                          checked="checked" @endif @endif > <label
                                                    for="inlineRadio4"> {{__('admin.general.video')}} </label></div>
                                        @error('media.type')
                                        <span class="help-block text-danger"><small>{{$message}}.</small></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">{{__('admin.sliders.source')}} : </label>
                                    <div class="col-md-10">
                                        <div class="radio radio-info radio-inline"><input type="radio"
                                                                                          id="inlineRadio2"
                                                                                          value="upload"
                                                                                          name="media[source]"
                                                                                          @if(old('media.source')) @if(old('media.source') == 'upload') checked="checked" @endif
                                                                                          @elseif(isset($slider))
                                                                                          @if($slider->media['source'] == 'upload')
                                                                                          checked="checked" @endif
                                                                                          @else checked="checked" @endif>
                                            <label for="inlineRadio2"> {{__('admin.general.file_upload')}} </label></div>
                                        <div class="radio radio-info radio-inline"><input type="radio" id="inlineRadio3"
                                                                                          value="link"
                                                                                          name="media[source]"
                                                                                          @if(old('media.source')) @if(old('media.source') == 'link') checked="checked" @endif
                                                                                          @elseif(isset($slider))
                                                                                          @if($slider->media['source'] == 'link')
                                                                                          checked="checked" @endif @endif> <label
                                                    for="inlineRadio3"> {{__('admin.general.link')}} </label></div>
                                        @error('media.source')
                                        <span class="help-block text-danger"><small>{{$message}}.</small></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group source-upload">
                                    <label class="col-sm-2 control-label">{{__('admin.general.file')}} : </label>
                                    <div class="col-sm-10">
                                        <input name="file" type="file" class="form-control @error('file') parsley-error @enderror"
                                               value="{{old('file') ? old('file') : null}}">
                                        @isset($slider)
                                            @if($slider->media['source'] == 'upload' && $slider->media['type'] == 'image')
                                                <br>
                                                <img height="100" src="{{asset('data/'.$slider->media['value'])}}">
                                            @elseif ($slider->media['source'] == 'upload' && $slider->media['type'] == 'video')
                                                <a href="{{asset('data/'.$slider->media['value'])}}" target="_blank">{{__('admin.sliders.value')}}</a>
                                            @endif
                                            @endisset
                                        @error('file')
                                        <span class="help-block text-danger"><small>{{$message}}.</small></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group source-link">
                                    <label class="col-sm-2 control-label">{{__('admin.general.the_link')}} :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('phone') parsley-error @enderror"
                                               name="link"
                                               placeholder="{{__('admin.general.enter')}} {{__('admin.general.the_link')}}"
                                               value="{{old('link') ? old('link') : (isset($slider)? ($slider->media['source'] == 'link' ? $slider->media['value'] : null ): null)}}">
                                        @error('link')
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

    <script>
        function updateMedia(){
            let source = $('input[name="media[source]"]:checked').val();
            if(source == 'upload'){
                $('.source-upload').show();
                $('.source-link').hide();
            }
            else {
                $('.source-upload').hide();
                $('.source-link').show();
            }
        }
        $(document).ready(function () {
            $('input[name="media[source]"]').change(function () { console.log("change");updateMedia(); });
            updateMedia();
        });
    </script>
@endsection