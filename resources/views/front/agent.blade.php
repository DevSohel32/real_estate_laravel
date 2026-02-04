@extends('front.layouts.master')

@section('content')

    {{-- Hero --}}
    <section class="position-relative text-white"
        style="background:url('{{ asset('uploads/banner.jpg') }}') center/cover no-repeat;">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-75"></div>

        <div class="container position-relative py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <span class="badge bg-primary mb-3">Real Estate Agent</span>
                    <h1 class="fw-bold display-6">{{ $agent->name }}</h1>
                    <p class="opacity-75 mb-0">{{ $agent->designation }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Profile --}}
    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="row g-0">

                        {{-- Left --}}
                        <div class="col-md-4 bg-light text-center p-4">
                            <img src="{{ asset('uploads/' . $agent->photo) }}" class="rounded-circle img-fluid shadow mb-3"
                                style="width:170px;height:170px;object-fit:cover;">

                            <h5 class="fw-bold mb-1">{{ $agent->name }}</h5>
                            <small class="text-muted">{{ $agent->company }}</small>

                            <div class="d-flex justify-content-center gap-2 mt-3">
                                @if($agent->facebook)
                                    <a class="btn btn-outline-primary btn-sm rounded-circle" href="{{ $agent->facebook }}">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                @endif
                                @if($agent->linkedin)
                                    <a class="btn btn-outline-primary btn-sm rounded-circle" href="{{ $agent->linkedin }}">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                @endif
                                @if($agent->instagram)
                                    <a class="btn btn-outline-danger btn-sm rounded-circle" href="{{ $agent->instagram }}">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                @endif
                            </div>
                        </div>

                        {{-- Right --}}
                        <div class="col-md-8 p-4 p-lg-5">
                            <h4 class="fw-bold mb-3">About Agent</h4>

                            <p class="text-muted">
                                {!! nl2br(e($agent->biography)) !!}
                            </p>

                            <hr>

                            <div class="row gy-3">
                                @if($agent->phone)
                                    <div class="col-sm-6 d-flex align-items-start">
                                        <i class="fas fa-phone text-primary fs-5 me-3"></i>
                                        <div>
                                            <div class="fw-semibold">Phone</div>
                                            <small>{{ $agent->phone }}</small>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-sm-6 d-flex align-items-start">
                                    <i class="far fa-envelope text-primary fs-5 me-3"></i>
                                    <div>
                                        <div class="fw-semibold">Email</div>
                                        <small>{{ $agent->email }}</small>
                                    </div>
                                </div>
                                  @if($agent->address)
                                <div class="col-sm-6 d-flex align-items-start">
                                    <i class="fas fa-map-marker-alt text-primary fs-5 me-3"></i>
                                    <div>
                                        <div class="fw-semibold">Location</div>
                                        <small>{{ $agent->city }}, {{ $agent->country }}</small>
                                    </div>
                                </div>
                                @endif
                                @if($agent->website)
                                    <div class="col-sm-6 d-flex align-items-start">
                                        <i class="fas fa-globe text-primary fs-5 me-3"></i>
                                        <div>
                                            <div class="fw-semibold">Website</div>
                                            <small>
                                                <a href="{{ $agent->website }}" class="text-decoration-none">
                                                    Visit Website
                                                </a>
                                            </small>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-4">
                                <a href="tel:{{ $agent->phone }}" class="btn btn-primary rounded-pill px-4 me-2">
                                    <i class="fas fa-phone me-1"></i> Call Now
                                </a>
                                <a href="mailto:{{ $agent->email }}" class="btn btn-outline-secondary rounded-pill px-4">
                                    Message
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <div class="property ">
        <div class="container">
            <div class="row">
                @if($properties->count() == 0)
                    <div class="col-md-12">
                        <h3 class="text-lg font-semibold text-danger">No properties available in this location.</h3>
                    </div>
                @endif
                @foreach ($properties as $property)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="item">
                            <div class="photo">
                                <img class="main" src="{{ asset('uploads/' . $property->featured_photo) }}"
                                    alt="{{ $property->name }}">
                                <div class="top">

                                    @if ($property->purpose == "Sale")
                                        <div class="status-sale">
                                            For Sale
                                        </div>
                                    @else
                                        <div class="status-sale">
                                            For Rent
                                        </div>
                                    @endif
                                    @if ($property->is_featured == "Yes")
                                        <div class="featured">
                                            Featured
                                        </div>
                                    @endif
                                </div>
                                <div class="price">$ {{ $property->price }}</div>
                                <div class="wishlist"><a href=""><i class="far fa-heart"></i></a></div>
                            </div>
                            <div class="text">
                                <h3><a
                                        href="{{ route('property_detail', ['slug' => $property->slug]) }}">{{ $property->name }}</a>
                                </h3>
                                <div class="detail">
                                    <div class="stat">
                                        <div class="i1">{{ $property->size }} sqft</div>
                                        <div class="i2">{{ $property->bedroom }} Bed</div>
                                        <div class="i3">{{ $property->bathroom }} Bath</div>
                                    </div>
                                    <div class="address">
                                        <i class="fas fa-map-marker-alt"></i> {{ $property->address }}
                                    </div>
                                    <div class="type-location">
                                        <div class="i1">
                                            <i class="fas fa-edit"></i> {{ $property->type->name }}
                                        </div>
                                        <div class="i2">
                                            <i class="fas fa-location-arrow"></i> {{ $property->location->name }}
                                        </div>
                                    </div>
                                    <div class="agent-section">
                                        <img class="agent-photo" src="{{ asset('uploads/' . $property->agent->photo) }}"
                                            alt="{{ $property->agent->name }}">
                                        <a href="{{ route('agent', $property->agent->id) }}">{{ $property->agent->name }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-12">
                    {{ $properties->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection