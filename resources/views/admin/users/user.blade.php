@extends('admin.layouts.master')
@section('head')
    <title>{{__('admin.general.add')}} {{__('admin.general.user')}}</title>
    <link href="{{asset('admin/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/datatables/fixedHeader.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/datatables/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" /> -->
@endsection
@section('content')
    <div class="">
        <div class="page-header-title"><h4 class="page-title">{{__('admin.general.add')}} {{__('admin.general.user')}}</h4></div>
    </div>
    <div class="page-content-wrapper ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-body">

                            <form class="form-horizontal" role="form" action="{{ $user->id == null ? route('admin.users.store') : route('admin.users.update', $user->id) }}" method="post" enctype= "multipart/form-data">
                                        @csrf
                                        @isset($user->id)
                                            @method('put')
                                        @endisset
                                        <div class="form-group"><label class="col-md-2 control-label">{{__('admin.general.name')}} </label>
                                            <div class="col-md-10"><input type="text" class="form-control"                              placeholder="Enter Your Name" name="name"
                                                                          value="isset($user->id)? $user->name : null"></div>
                                        </div>
                                        <div class="form-group"><label class="col-md-2 control-label"
                                                                       for="example-email">{{__('admin.general.email')}} </label>
                                            <div class="col-md-10"><input type="email" id="example-email"
                                                                          name="email" class="form-control"
                                                                          placeholder="Enter Your Email"
                                                                          value="isset($user->id)? $user->email : null"></div>
                                        </div>
                                        <div class="form-group"><label class="col-md-2 control-label">{{__('admin.general.password')}} </label>
                                            <div class="col-md-10"><input type="password" class="form-control"
                                                                          placeholder="Enter Your Password"
                                                                          name="password" 
                                                                          value="isset($user->id)? $user->password : null"></div>
                                        </div>
                                        
                                        <div class="form-group"><label class="col-sm-2 control-label">{{__('admin.general.phone')}} </label>
                                            <div class="col-sm-10"><input type="number" class="form-control"
                                                                        name="phone" 
                                                                         placeholder="Enter Your Phone"
                                                                         value="isset($user->id)? $user->phone : null">
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">{{__('admin.general.role')}} </label>
                                            <div class="col-sm-10"><select class="form-control roles" name="role_id" value="isset($user->id)? $user->role_id : null">
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">              {{__('admin.general.pic')}} </label>
                                            <div class="col-sm-10">
                                                <input name="pic" type="file" class="form-control" value="isset($user->id)? $user->pic : null">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="form-control btn btn-primary">Submit</button>
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
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> -->
    <!-- <script>
        // $(document).ready(function() {
        //     $('.roles').select2();
        // });
    </script>
 -->@endsection