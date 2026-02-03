@extends('front.layouts.master')
@section('content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Location: {{ $location->name }}</h2>
                </div>
            </div>
        </div>
    </div>
     <div class="location pb_40">
        <div class="container">
            <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="item">
                            <div class="photo">
                                <a href="{{ route('location',$location->slug) }}"><img src="{{ asset('uploads/' . $location->photo) }}" alt="{{ $location->name }}"></a>
                            </div>
                            <div class="text">
                                <h2><a href="{{ route('location',$location->slug) }}">{{ $location->name }}</a></h2>
                                <h4>({{$location->properties_count }} Properties)</h4>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
