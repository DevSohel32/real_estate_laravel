@extends('admin.layouts.master')

@section('content')
    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><i class="fas fa-home mr-2 text-primary"></i> Property Details</h1>
                <div class="section-header-breadcrumb">
                    <a href="{{ route('admin_property_index') }}" class="btn btn-primary btn-icon icon-left shadow-primary">
                        <i class="fas fa-chevron-left"></i> Back to List
                    </a>
                </div>
            </div>

            <div class="section-body">
                @foreach ($properties as $property)
                    <div class="row">
                        <div class="col-lg-8">

                            <div class="card shadow-sm border-0 mb-4">
                                <img src="{{ asset('uploads/' . $property->featured_photo) }}"
                                    class="card-img-top main-details-img" alt="{{ $property->name }}">
                                <div class="card-body">
                                    <div class="row text-center py-3 border-bottom mb-4">
                                        <div class="col-4 border-right">
                                            <h6 class="text-muted text-uppercase small">Bedrooms</h6>
                                            <h4 class="font-weight-bold mb-0"><i class="fas fa-bed text-primary mr-1"></i>
                                                {{ $property->bedroom }}</h4>
                                        </div>
                                        <div class="col-4 border-right">
                                            <h6 class="text-muted text-uppercase small">Bathrooms</h6>
                                            <h4 class="font-weight-bold mb-0"><i class="fas fa-bath text-primary mr-1"></i>
                                                {{ $property->bathroom }}</h4>
                                        </div>
                                        <div class="col-4">
                                            <h6 class="text-muted text-uppercase small">Area Size</h6>
                                            <h4 class="font-weight-bold mb-0"><i
                                                    class="fas fa-ruler-combined text-primary mr-1"></i> {{ $property->size }}
                                                <span class="small">sqft</span>
                                            </h4>
                                        </div>
                                    </div>

                                    <h4 class="section-title">Description</h4>
                                    <div class="property-description text-muted">
                                        {!! $property->description !!}
                                    </div>
                                </div>
                            </div>

                            @if($property->photos->count() > 0)
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-header bg-white border-0">
                                        <h4 class="text-dark"><i class="fas fa-images mr-2 text-primary"></i>Photo Gallery</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row gutters-sm">
                                            @foreach($property->photos as $photo)
                                                <div class="col-6 col-md-4 col-lg-3 mb-3">
                                                    <a href="{{ asset('uploads/' . $photo->photo) }}" class="magnific"
                                                        title="Property Image">
                                                        <div class="gallery-item-container">
                                                            <img src="{{ asset('uploads/' . $photo->photo) }}"
                                                                class="img-fluid rounded shadow-sm">
                                                            <div class="gallery-hover-eye">
                                                                <i class="fas fa-search-plus"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($property->videos->count() > 0)
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-header bg-white border-0">
                                        <h4><i class="fas fa-video mr-2 text-primary"></i>Property Videos</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach($property->videos as $video)
                                                <div class="col-md-6 mb-3">
                                                    <a class="video-button" href="https://www.youtube.com/watch?v={{ $video->video }}">
                                                        <div class="video-thumb-wrapper rounded shadow-sm">
                                                            <img src="http://img.youtube.com/vi/{{ $video->video }}/maxresdefault.jpg"
                                                                class="img-fluid w-100">
                                                            <div class="video-play-icon">
                                                                <i class="fab fa-youtube"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-lg-4">

                            <div class="card bg-primary text-white shadow-primary mb-4">
                                <div class="card-body p-4 text-center">
                                    <h5 class="text-white-50 text-uppercase small">Property Price</h5>
                                    <h2 class="display-4 font-weight-bold mb-0">${{ $property->price }}</h2>
                                    <hr class="border-light opacity-2">
                                    <div class="d-flex justify-content-around">
                                        <span class="badge badge-pill badge-warning px-3">{{ $property->purpose }}</span>
                                        <span class="badge badge-pill badge-light px-3">{{ $property->type->name }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h6 class="font-weight-bold mb-3">Key Information</h6>
                                    <div class="list-unstyled list-unstyled-border">
                                        <div class="media mb-3">
                                            <div class="media-body">
                                                <div class="text-muted small">Location</div>
                                                <div class="font-weight-bold text-dark">{{ $property->location->name }}</div>
                                            </div>
                                        </div>
                                        <div class="media mb-3">
                                            <div class="media-body">
                                                <div class="text-muted small">Year Built</div>
                                                <div class="font-weight-bold text-dark">{{ $property->built_year }}</div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="text-muted small">Date Posted</div>
                                                <div class="font-weight-bold text-dark">
                                                    {{ $property->created_at->format('M d, Y') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow-sm border-0">
                                <div class="card-header bg-white">
                                    <h4>Assigned Agent</h4>
                                </div>
                                <div class="card-body text-center">
                                    <img src="{{ asset('uploads/' . ($property->agent->photo ?? 'default.png')) }}"
                                        class="rounded-circle mb-3 border border-primary p-1"
                                        style="width: 80px; height: 80px; object-fit: cover;">
                                    <h5 class="mb-0 text-dark">{{ $property->agent->name }}</h5>
                                    <p class="text-muted small mb-4">Official Property Agent</p>

                                    <div class="text-left bg-light p-3 rounded">
                                        <div class="mb-2"><i class="fas fa-envelope text-primary mr-2"></i>
                                            {{ $property->agent->email }}</div>
                                        <div><i class="fas fa-phone text-primary mr-2"></i>
                                            {{ $property->agent->phone ?? 'Not provided' }}</div>
                                    </div>
                                </div>
                            </div>

                            @if($property->amenities)
                                <div class="card shadow-sm border-0">
                                    <div class="card-header bg-white">
                                        <h4>Amenities</h4>
                                    </div>
                                    <div class="card-body pb-2">
                                        @foreach(explode(',', $property->amenities) as $amenity)
                                            <span class="badge badge-light border mb-2 mr-1">
                                                <i class="fas fa-check-circle text-success mr-1"></i> {{ trim($amenity) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>



@endsection
    <style>
        /* Styling to match the "Eye" icon and zoom effect in your screenshot */
        .gallery-item-container {
            position: relative;
            overflow: hidden;
            border-radius: 5px;
            cursor: zoom-in;
        }

        .gallery-item-container img {
            transition: transform 0.3s ease;
            width: 100%;
            height: 120px;
            object-fit: cover;
        }

        .gallery-hover-eye {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: 0.3s;
            color: #fff;
            font-size: 1.5rem;
        }

        .gallery-item-container:hover img {
            transform: scale(1.1);
        }

        .gallery-item-container:hover .gallery-hover-eye {
            opacity: 1;
        }

        /* Video Play Button Styling */
        .video-thumb-wrapper {
            position: relative;
            cursor: pointer;
        }

        .video-play-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 3rem;
            color: #ff0000;
            transition: 0.3s;
            text-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        .video-thumb-wrapper:hover .video-play-icon {
            transform: translate(-50%, -50%) scale(1.2);
            color: #fff;
        }
    </style>