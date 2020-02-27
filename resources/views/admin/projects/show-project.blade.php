@extends('admin.layouts.master')
@section('head')
    <title>{{__('admin.general.projects')}} - {{__('admin.general.list')}} {{__('admin.general.projects')}}</title>
    @include('admin.partials.datatable_styles')
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

                            <h4 class="m-b-30 m-t-0">{{__('admin.general.list')}} {{__('admin.general.projects')}}

                            <a href="{{ route('admin.projects.create') }}" class="btn btn-success  m-b-30 m-t-0 m-r-0 m-l-30 pull-right">
                                 <i class="fa fa-plus" aria-hidden="true"></i>
                                    {{__('admin.general.add')}} {{__('admin.general.project')}}
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
                                    <!-- <th>{{__('admin.general.logo')}}</th> -->
                                    <th>{{__('admin.general.status')}}</th>
                                    <th>{{__('admin.general.ends_at')}}</th>
                                    <th>{{__('admin.general.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                

                                    <tr>
                                        <td>{{$project->name}}</td>
                                        <!-- <td><img src="{{URL::asset('/data/' . $project->name . '/' . $project->logo)}}" class="css-class" width="15%" height="10%" alt="alt text">
                                        </td> -->
                                        <td>{{$project->status}}</td>
                                        <td>{{$project->ends_at}}</td>
                                        <td>
                                            <a href="{{ route('admin.projects.edit' , $project->id) }}" class="btn btn-primary btn-sm pull-left">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                 {{__('admin.general.edit')}} {{__('admin.general.project')}}
                                            </a>


                                            <button class="btn btn-danger btn-sm m-l-10" onclick="deleteproject('{{$project->id}}')">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                {{__('admin.general.delete')}}  
                                                {{__('admin.general.project')}}
                                            </button>

                                            <a href="{{ route('admin.projects.show' , $project->id) }}" class="btn btn-primary btn-sm pull-left m-l-10">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                 {{__('admin.general.show')}} {{__('admin.general.project')}}
                                            </a>

                                        </td>
                                        <form id="delete-{{$project->id}}" action="{{route('admin.projects.destroy', $project->id)}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </tr>
                                    
                                    
                                </tbody>
                            </table>
                            <div class="text-center">
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
@endsection