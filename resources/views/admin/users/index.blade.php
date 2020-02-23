@extends('admin.layouts.master')
@section('head')
    <title>{{__('admin.general.users')}} - {{__('admin.general.list')}} {{__('admin.general.users')}}</title>
    <link href="{{asset('admin/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/datatables/fixedHeader.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/datatables/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
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

                            <h4 class="m-b-30 m-t-0">{{__('admin.general.list')}} {{__('admin.general.users')}}</h4>

                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm m-b-30 m-t-0 m-r-0 m-l-30" target="_blank">
                                 <i class="fa fa-plus" aria-hidden="true"></i>
                                    {{__('admin.general.add')}} {{__('admin.general.user')}}
                            </a>

                            <table id="datatable-responsive"
                                   class="table table-striped table-bordered dt-responsive nowrap"
                                   cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>
                                            <a href="{{ route('admin.users.edit' , $user->id) }}" class="btn btn-primary btn-sm pull-left" target="_blank">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                 {{__('admin.general.edit')}} {{__('admin.general.user')}}
                                            </a>
                                            <form action="{{route('admin.users.destroy', $user->id)}}" method="post" class="">
                                                @method('DELETE')
                                                @csrf

                                                <button class="btn btn-danger btn-sm pull-right" type="submit">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    {{__('admin.general.delete')}} {{__('admin.general.user')}}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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