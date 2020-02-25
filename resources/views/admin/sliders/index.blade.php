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

                            <h4 class="m-b-30 m-t-0">{{__('admin.general.list')}} {{__('admin.sliders.title')}}

                                <a href="{{ route('admin.sliders.create', ['type'=>$type]) }}" class="btn btn-success  m-b-30 m-t-0 m-r-0 m-l-30 pull-right">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    {{__('admin.general.add')}} {{__('admin.sliders.slider')}}
                                </a>
                            </h4>
                            <h4 class="text-center p-t-10 p-b-10 @error('success') bg-success @enderror @error('error') bg-danger @enderror">
                                @error('success')
                                {{$message}}
                                @enderror
                                @error('error')
                                {{$message}}
                                @enderror
                            </h4>
                            <table id="datatable-responsive"
                                   class="table table-striped table-bordered dt-responsive nowrap"
                                   cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>{{__('admin.sliders.type')}}</th>
                                    <th>{{__('admin.sliders.source')}}</th>
                                    <th>{{__('admin.sliders.value')}}</th>
                                    <th>{{__('admin.general.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sliders as $slider)
                                    @if(Gate::allows('view', $slider))
                                        <tr>
                                            <td>{{__('admin.general.'.$slider->media['type'])}}</td>
                                            <td>{{__('admin.general.'.$slider->media['source'])}}</td>
                                            <td>
                                                @if($slider->media['source'] == 'upload' && $slider->media['type'] == 'image')
                                                    <img height="100" src="{{asset('data/'.$slider->media['value'])}}">
                                                @elseif ($slider->media['source'] == 'upload' && $slider->media['type'] == 'video')
                                                    <a href="{{asset('data/'.$slider->media['value'])}}" target="_blank">{{__('admin.sliders.value')}}</a>
                                                @else
                                                    <a href="{{$slider->media['value']}}" target="_blank">{{__('admin.sliders.value')}}</a>
                                                @endif


                                            </td>
                                            <td>
                                                <a href="{{ route('admin.sliders.edit' , ['slider'=>$slider->id, 'type'=>$type]) }}" class="btn btn-primary btn-sm pull-left">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    {{__('admin.general.edit')}} {{__('admin.sliders.slider')}}
                                                </a>


                                                <button class="btn btn-danger btn-sm m-l-10" onclick="deleteslider('{{$slider->id}}')">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    {{__('admin.general.delete')}} {{__('admin.sliders.slider')}}
                                                </button>
                                            </td>
                                            <form id="delete-{{$slider->id}}" action="{{route('admin.sliders.destroy', ['slider'=>$slider->id, 'type'=>$type])}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{$sliders->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('admin.partials.datatable_scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function deleteslider(slider_id){
            swal({
                title: "{{__('admin.general.sure')}}",
                text: "{{__('admin.general.confirm?')}}",
                icon: "warning",
                buttons: ['{{__('admin.general.cancel')}}', '{{__('admin.general.confirm')}}'],
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#delete-'+slider_id).submit();
                    } else {
                        return false;
                    }
                });
        }
    </script>
@endsection