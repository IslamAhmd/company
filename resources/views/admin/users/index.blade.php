@extends('admin.layouts.master')
@section('head')
    <title>{{__('admin.general.users')}} - {{__('admin.general.list')}} {{__('admin.general.users')}}</title>
    @include('admin.partials.datatable_styles')
@endsection
@section('content')
    <div class="">
        <div class="page-header-title"><h4 class="page-title">{{__('admin.general.users')}}</h4></div>
    </div>
    <div class="page-content-wrapper ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-body">

                            <h4 class="m-b-30 m-t-0">{{__('admin.general.list')}} {{__('admin.general.users')}}

                            <a href="{{ route('admin.users.create') }}" class="btn btn-success  m-b-30 m-t-0 m-r-0 m-l-30 pull-right">
                                 <i class="fa fa-plus" aria-hidden="true"></i>
                                    {{__('admin.general.add')}} {{__('admin.general.user')}}
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
                                    <th>{{__('admin.general.name')}}</th>
                                    <th>{{__('admin.general.email')}}</th>
                                    <th>{{__('admin.general.phone')}}</th>
                                    <th>{{__('admin.general.role')}}</th>
                                    <th>{{__('admin.general.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    @if(Gate::allows('view', $user))
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>@if($user->role){{__('admin.roles.'.$user->role->name)}}@endif</td>
                                        <td>
                                            <a href="{{ route('admin.users.edit' , $user->id) }}" class="btn btn-primary btn-sm pull-left">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                 {{__('admin.general.edit')}} {{__('admin.general.user')}}
                                            </a>


                                                <button class="btn btn-danger btn-sm m-l-10" onclick="deleteUser('{{$user->id}}')">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    {{__('admin.general.delete')}} {{__('admin.general.user')}}
                                                </button>
                                        </td>
                                        <form id="delete-{{$user->id}}" action="{{route('admin.users.destroy', $user->id)}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{$users->links()}}
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
        function deleteUser(user_id){
            swal({
                title: "{{__('admin.general.sure')}}",
                text: "{{__('admin.general.confirm?')}}",
                icon: "warning",
                buttons: ['{{__('admin.general.cancel')}}', '{{__('admin.general.confirm')}}'],
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#delete-'+user_id).submit();
                    } else {
                        return false;
                    }
                });
        }
    </script>
@endsection