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
                            <h4 class="m-b-30 m-t-0">{{__('admin.general.list')}} {{__('admin.headers.title')}}
                                <a href="{{ route('admin.headers.create', ['type'=>$type]) }}" class="btn btn-success  m-b-30 m-t-0 m-r-0 m-l-30 pull-right">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    {{__('admin.general.add')}} {{__('admin.headers.header')}}
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
                                    <th>{{__('admin.general.the_text')}}</th>
                                    <th>{{__('admin.general.lang')}}</th>
                                    <th>{{__('admin.general.pic')}}</th>
                                    <th>{{__('admin.general.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($headers as $header)
                                    @if(Gate::allows('view', $header))
                                        <tr>
                                            <td>{{$header->text}}</td>
                                            <td>{{__('admin.general.'.$header->lang)}}</td>
                                            <td>
                                                <img src="{{asset('data/'.$header->pic)}}" height="100">

                                            </td>
                                            <td>
                                                <a href="{{ route('admin.headers.edit' , ['header'=>$header->id, 'type'=>$type]) }}" class="btn btn-primary btn-sm pull-left">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    {{__('admin.general.edit')}} {{__('admin.headers.header')}}
                                                </a>

                                                <button class="btn btn-danger btn-sm m-l-10" onclick="deleteheader('{{$header->id}}')">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    {{__('admin.general.delete')}} {{__('admin.headers.header')}}
                                                </button>
                                            </td>
                                            <form id="delete-{{$header->id}}" action="{{route('admin.headers.destroy', ['header'=>$header->id, 'type'=>$type])}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{$headers->links()}}
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
        function deleteheader(header_id){
            swal({
                title: "{{__('admin.general.sure')}}",
                text: "{{__('admin.general.confirm?')}}",
                icon: "warning",
                buttons: ['{{__('admin.general.cancel')}}', '{{__('admin.general.confirm')}}'],
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#delete-'+header_id).submit();
                    } else {
                        return false;
                    }
                });
        }
    </script>
@endsection