@extends('admin.layouts.master')
@section('head')
    <title>{{__('admin.general.add')}} {{__('admin.general.user')}}</title>
    <link href="{{asset('admin/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('admin/plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/datatables/fixedHeader.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/plugins/datatables/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" /> -->
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
                            <h4 class="m-b-30 m-t-0">{{__('admin.general.add')}} {{__('admin.general.users')}}</h4>

                            <form class="form-horizontal" role="form"
                                  action="@if(isset($user)){{ route('admin.users.update', $user->id) }} @else {{  route('admin.users.store') }} @endif"
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                @isset($user)
                                    @method('put')
                                @endisset
                                <div class="form-group">
                                    <label class="col-md-2 control-label">{{__('admin.general.name')}} </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control @error('name') parsley-error @enderror"
                                               placeholder="{{__('admin.general.enter')}} {{__('admin.general.name')}}" name="name"
                                               value="{{isset($user->id)? $user->name : null}}">
                                        @error('name')
                                        <span class="help-block text-danger"><small>{{$message}}.</small></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="example-email">{{__('admin.general.email')}} </label>
                                    <div class="col-md-10">
                                        <input type="email" id="example-email"
                                               name="email" class="form-control @error('email') parsley-error @enderror"
                                               placeholder="{{__('admin.general.enter')}} {{__('admin.general.email')}}"
                                               value="{{isset($user->id)? $user->email : null}}">
                                        @error('email')
                                        <span class="help-block text-danger"><small>{{$message}}.</small></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">{{__('admin.general.password')}} </label>
                                    <div class="col-md-10">
                                        <input type="password" class="form-control @error('password') parsley-error @enderror"
                                               placeholder="{{__('admin.general.enter')}} {{__('admin.general.password')}}"
                                               name="password"
                                               value="">
                                        @error('password')
                                        <span class="help-block text-danger"><small>{{$message}}.</small></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{{__('admin.general.phone')}} </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('phone') parsley-error @enderror"
                                               name="phone"
                                               placeholder="{{__('admin.general.enter')}} {{__('admin.general.phone')}}"
                                               value="{{isset($user)? $user->phone : null}}">
                                        @error('phone')
                                        <span class="help-block text-danger"><small>{{$message}}.</small></span>
                                        @enderror
                                    </div>
                                </div>
                                @if(Auth::user()->isAdmin())
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{{__('admin.general.role')}} </label>
                                    <div class="col-sm-10">
                                        <select class="form-control roles @error('role_id') parsley-error @enderror" name="role_id">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" @isset($user) @if($user->role_id == $role->id) selected @endif @endisset>{{ __('admin.roles.'.$role->name) }}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                        <span class="help-block text-danger"><small>{{$message}}.</small></span>
                                        @enderror
                                    </div>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{{__('admin.general.pic')}} </label>
                                    <div class="col-sm-10">
                                        <input name="pic" type="file" class="form-control @error('pic') parsley-error @enderror"
                                               value="{{isset($user->id)? $user->pic : null}}">
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