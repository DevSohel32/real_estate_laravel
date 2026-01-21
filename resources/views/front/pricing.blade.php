@extends('front.layouts.master')

@section('content')
    <!-- Pricing Content Here -->


    <div class="page-top" style="background-image: url('uploads/banner.jpg')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Pricing</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content pricing">
        <div class="container">
            <div class="row pricing">


                @foreach ($packages as $package)
                    <div class="col-lg-4 mb_30">
                    <div class="card mb-5 mb-lg-0">
                        <div class="card-body">
                            <h2 class="card-title">{{ $package->name }}</h2>
                            <h3 class="card-price">${{ $package->price }}</h3>
                            <h4 class="card-day">({{ $package->allowed_days }} Days)</h4>
                            <hr />
                            <ul class="fa-ul">
                                <li>
                                    <span class="fa-li">
                                        <i class="fas {{ $package->allowed_properties > 0 || $package->allowed_properties == -1 ? 'fa-check text-success' : 'fa-times text-danger' }}"></i>
                                    </span>
                                    @if($package->allowed_properties == -1)
                                        Unlimited
                                    @elseif($package->allowed_properties == 0)
                                        No
                                    @else
                                        {{ $package->allowed_properties }}
                                    @endif 
                                    Properties Allowed
                                </li>

                                <li>
                                    <span class="fa-li">
                                        <i class="fas {{ $package->allowed_featured_properties > 0 || $package->allowed_featured_properties == -1 ? 'fa-check text-success' : 'fa-times text-danger' }}"></i>
                                    </span>
                                    @if($package->allowed_featured_properties == -1)
                                        Unlimited
                                    @elseif($package->allowed_featured_properties == 0)
                                        No
                                    @else
                                        {{ $package->allowed_featured_properties }}
                                    @endif 
                                    Featured Property
                                </li>

                                <li>
                                    <span class="fa-li">
                                        <i class="fas {{ $package->allowed_photos > 0 || $package->allowed_photos == -1 ? 'fa-check text-success' : 'fa-times text-danger' }}"></i>
                                    </span>
                                    @if($package->allowed_photos == -1)
                                        Unlimited
                                    @elseif($package->allowed_photos == 0)
                                        No
                                    @else
                                        {{ $package->allowed_photos }}
                                    @endif 
                                    Photos per Property
                                </li>

                                <li>
                                    <span class="fa-li">
                                        <i class="fas {{ $package->allowed_videos > 0 || $package->allowed_videos == -1 ? 'fa-check text-success' : 'fa-times text-danger' }}"></i>
                                    </span>
                                    @if($package->allowed_videos == -1)
                                        Unlimited
                                    @elseif($package->allowed_videos == 0)
                                        No
                                    @else
                                        {{ $package->allowed_videos }}
                                    @endif 
                                    Videos per Property
                                </li>
                            </ul>
                            <div class="buy">
                                <a href="" class="btn btn-primary">
                                    Choose Plan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
             
            </div>
        </div>
    </div>
@endsection