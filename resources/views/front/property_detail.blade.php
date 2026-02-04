@extends('front.layouts.master')

@section('content')
    <!--Property details Content Here -->
    <div class="page-top" style="background-image: url({{ asset('uploads/banner.jpg') }})">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Property Details</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="property-result pt_50 pb_50">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="left-item">
                        <div class="main-photo">
                            <img src="{{ asset('uploads/' . $property->featured_photo) }}" alt="{{ $property->name }}">
                        </div>
                        <h2>
                            Description
                        </h2>
                        <p>
                            {{ $property->description }}
                        </p>
                    </div>
                    @if($property->photos->count() > 0)
                        <div class="left-item">
                            <h2>
                                Photos
                            </h2>
                            <div class="photo-all">
                                <div class="row">
                                    @foreach ($property->photos as $photo)
                                        <div class="col-md-6 col-lg-4">
                                            <div class="item">
                                                <a href="{{ asset('uploads/' . $photo->photo) }}" class="magnific">
                                                    <img src="{{ asset('uploads/' . $photo->photo) }}" alt="" />
                                                    <div class="icon">
                                                        <i class="fas fa-plus"></i>
                                                    </div>
                                                    <div class="bg"></div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info py-4 text-center">
                            <h3 class="text-lg font-semibold">No photos available for this property.</h3>
                        </div>
                    @endif

                    @if($property->videos->count() > 0)
                        <div class="left-item">
                            <h2>
                                Videos
                            </h2>
                            <div class="video-all">
                                <div class="row">
                                    @foreach ($property->videos as $video)
                                        <div class="col-md-6 col-lg-4">
                                            <div class="item">
                                                <a class="video-button" href="http://www.youtube.com/watch?v={{ $video->video }}">
                                                    <img src="http://img.youtube.com/vi/{{ $video->video }}/0.jpg" alt="" />
                                                    <div class="icon">
                                                        <i class="far fa-play-circle"></i>
                                                    </div>
                                                    <div class="bg"></div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info py-4 text-center">
                            <h3 class="text-lg font-semibold">No videos available for this property.</h3>
                        </div>
                    @endif

                    <div class="left-item mb_50">
                        <h2>Share</h2>
                        <div class="share">
                            <a class="facebook"
                                href="https://www.facebook.com/sharer/sharer.php?u=[INSERT_URL]&picture=[INSERT_PHOTO]"
                                target="_blank">
                                Facebook
                            </a>
                            <a class="twitter" href="https://twitter.com/share?url=[INSERT_URL]&text=[INSERT_TEXT]"
                                target="_blank">
                                Twitter
                            </a>
                            <a class="linkedin"
                                href="https://www.linkedin.com/shareArticle?mini=true&url=[INSERT_URL]&title=[INSERT_TITLE]&summary=[INSERT_SUMMARY]"
                                target="_blank">
                                LinkedIn
                            </a>
                        </div>
                    </div>
                    <div class="left-item">
                        <h2>
                            Related Properties
                        </h2>
                        <div class="property related-property pt_0 pb_0">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="item">
                                        <div class="photo">
                                            <img class="main" src="uploads/property1.jpg" alt="">
                                            <div class="top">
                                                <div class="status-sale">
                                                    For Sale
                                                </div>
                                                <div class="featured">
                                                    Featured
                                                </div>
                                            </div>
                                            <div class="price">$56,000</div>
                                            <div class="wishlist"><a href=""><i class="far fa-heart"></i></a></div>
                                        </div>
                                        <div class="text">
                                            <h3><a href="property.html">Sea Side Property</a></h3>
                                            <div class="detail">
                                                <div class="stat">
                                                    <div class="i1">2500 sqft</div>
                                                    <div class="i2">2 Bed</div>
                                                    <div class="i3">2 Bath</div>
                                                </div>
                                                <div class="address">
                                                    <i class="fas fa-map-marker-alt"></i> 937 Jamajo Blvd, Orlando FL 32803
                                                </div>
                                                <div class="type-location">
                                                    <div class="i1">
                                                        <i class="fas fa-edit"></i> Villa
                                                    </div>
                                                    <div class="i2">
                                                        <i class="fas fa-location-arrow"></i> Orland
                                                    </div>
                                                </div>
                                                <div class="agent-section">
                                                    <img class="agent-photo" src="uploads/agent1.jpg" alt="">
                                                    <a href="">Robert Johnson (AA Property)</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="item">
                                        <div class="photo">
                                            <img class="main" src="uploads/property2.jpg" alt="">
                                            <div class="top">
                                                <div class="status-rent">
                                                    For Rent
                                                </div>
                                                <div class="featured">
                                                    Featured
                                                </div>
                                            </div>
                                            <div class="price">$4,900</div>
                                            <div class="wishlist"><a href=""><i class="far fa-heart"></i></a></div>
                                        </div>
                                        <div class="text">
                                            <h3><a href="property.html">Modern Villa</a></h3>
                                            <div class="detail">
                                                <div class="stat">
                                                    <div class="i1">2500 sqft</div>
                                                    <div class="i2">2 Bed</div>
                                                    <div class="i3">2 Bath</div>
                                                </div>
                                                <div class="address">
                                                    <i class="fas fa-map-marker-alt"></i> 2006 E Central Blvd, Orlando FL
                                                    32803
                                                </div>
                                                <div class="type-location">
                                                    <div class="i1">
                                                        <i class="fas fa-edit"></i> Condo
                                                    </div>
                                                    <div class="i2">
                                                        <i class="fas fa-location-arrow"></i> Orland
                                                    </div>
                                                </div>
                                                <div class="agent-section">
                                                    <img class="agent-photo" src="uploads/agent2.jpg" alt="">
                                                    <a href="">Eric Williams (BB Property)</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">

                    <div class="right-item">
                        <h2>Agent</h2>
                        <div class="agent-right d-flex justify-content-start">
                            <div class="left">
                                <img src="{{ asset('uploads/' . $property->agent->photo) }}" alt="">
                            </div>
                            <div class="right">
                                <h3><a href="">{{ $property->agent->name }}</a></h3>
                                <h4>{{ $property->agent->designation }}</h4>
                            </div>
                        </div>
                        <div class="table-responsive mt_25">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Posted On: </td>
                                    <td>{{$property->created_at->format('d M, Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Email: </td>
                                    <td>{{ $property->agent->email }}</td>
                                </tr>
                                <tr>
                                    <td>Phone: </td>
                                    <td>{{ $property->agent->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Social: </td>
                                    <td>
                                        <ul class="agent-ul">
                                            {{-- Facebook --}}
                                            @if($property->agent->facebook)
                                                <li>
                                                    <a href="{{ $property->agent->facebook }}" target="_blank">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                            @endif

                                            {{-- Twitter --}}
                                            @if($property->agent->twitter)
                                                <li>
                                                    <a href="{{ $property->agent->twitter }}" target="_blank">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                            @endif

                                            {{-- Instagram --}}
                                            @if($property->agent->instagram)
                                                <li>
                                                    <a href="{{ $property->agent->instagram }}" target="_blank">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                </li>
                                            @endif

                                            {{-- LinkedIn --}}
                                            @if($property->agent->linkedin)
                                                <li>
                                                    <a href="{{ $property->agent->linkedin }}" target="_blank">
                                                        <i class="fab fa-linkedin-in"></i>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="right-item">
                        <h2>Features</h2>
                        <div class="summary">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <td><b>Price</b></td>
                                        <td>${{ $property->price }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Location</b></td>
                                        <td>{{ $property->location->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Type</b></td>
                                        <td> {{ $property->type->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Status</b></td>
                                        @if ($property->purpose == "Rent")
                                            <td>For Rent</td>
                                        @else
                                            <td>For Sale</td>
                                        @endif

                                    </tr>
                                    <tr>
                                        <td><b>Bedroom:</b></td>
                                        <td>{{ $property->bedroom }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Bathroom:</b></td>
                                        <td>{{ $property->bathroom }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Size:</b></td>
                                        <td>{{ $property->size }} sqft</td>
                                    </tr>
                                    <tr>
                                        <td><b>Floor:</b></td>
                                        <td>{{ $property->floor }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Garage:</b></td>
                                        <td>{{ $property->garage }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Balcony:</b></td>
                                        <td>{{ $property->balcony }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Address:</b></td>
                                        <td>{{ $property->address }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Built Year:</b></td>
                                        <td>{{ $property->built_year }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if($property->amenities)
                        <div class="right-item">
                            <h2>Amenities</h2>
                            <div class="amenity">
                                <ul class="amenity-ul">
                                     @foreach(explode(',', $property->amenities) as $amenity)
                                    <li><i class="fas fa-check-square"></i> {{ trim($amenity) }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    @endif
                    <div class="right-item">
                        <h2>Location Map</h2>
                        <div class="location-map">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3629.2542091435403!2d-97.90512175238419!3d38.06450160184029!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e0!3m2!1sen!2sbd!4v1671347381733!5m2!1sen!2sbd"
                                width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>

                    <div class="right-item">
                        <h2>Enquery Form</h2>
                        <div class="enquery-form">
                            <form action="" method="post">
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Full Name" />
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email Address" />
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Phone Number" />
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control h-150" rows="3" placeholder="Message"></textarea>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection