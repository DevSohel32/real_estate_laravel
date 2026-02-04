@extends('front.layouts.master')
@section('content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Contact</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="location pb_40">
        <div class="container">
            <div class="row">
                @foreach ($agents as $agent)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="item">
                            <div class="photo">
                                <a href="{{ route('agent', $agent->id) }}"><img src="{{ asset('uploads/' . $agent->photo) }}"
                                        alt="{{ $agent->name }}"></a>
                            </div>
                            <div class="text">
                                <h2><a href="{{ route('agent', $agent->id) }}">{{ $agent->name }}</a></h2>
                                <h4>({{$agent->properties_count }} Properties)</h4>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-md-12">
                    {{ $agents->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection