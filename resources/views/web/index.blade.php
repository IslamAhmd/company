@extends('web.layouts.master')
@section('content')
    <div class="container p-0">
        <div class="d-flex justify-content-center h-100">
            <div class="searchbar">
                <input class="search_input" type="text" name="" placeholder="Search...">
                <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
            </div>
        </div>
        <div class="row top-head">
            <div class="col-6 p-6 h-100">
                @if($top_header)
                    <div class="w-100" style="height: 80%;">
                        <img src="{{asset('data/'.$top_header->pic)}}" height="100%" width="100%">
                    </div>
                    <div class="w-100 text-center">{{$top_header->text}}</div>
                @endif
            </div>
            <div class="col-6 p-0">
                <div class=" w-100 h-100">
                    <div class="top-slider h-100">
                        @foreach($top_sliders as $slider)
                            @if($slider->media['type'] == 'image' && $slider->media['source'] == 'upload')
                                <div class="h-100 text-center">
                                    <img src="{{asset('data/'.$slider->media['value'])}}" height="100%" width="100%">
                                    {{--<div class="h-100 w-100" style="background: url({{asset('data/'.$slider->media['value'])}}); background-size: cover"></div>--}}
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('.top-head .top-slider').slick({
                infinite: true,
                adaptiveHeight: true,
                autoplay: true,
                autoplaySpeed: 3000
            });
        });
    </script>
@endsection