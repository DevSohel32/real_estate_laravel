@extends('front.layouts.master')

@section('content')
<div class="page-top" style="background-image: url('uploads/banner.jpg')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Property Listing</h2>
                </div>
            </div>
        </div>
    </div>
   <div class="property-result">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="property-filter">
                        <div class="widget">
                            <h2>Find Anything</h2>
                            <input type="text" name="" class="form-control" placeholder="Search Titles ..." />
                        </div>

                        <div class="widget">
                            <h2>Location</h2>
                            <select name="" class="form-control select2">
                                <option value="">--- Select ---</option>
                                <option value="">Boston</option>
                                <option value="">California</option>
                                <option value="">Chicago</option>
                                <option value="">Dallas</option>
                                <option value="">Denver</option>
                                <option value="">NewYork</option>
                                <option value="">San Diago</option>
                                <option value="">Washington</option>
                                <option value="">Winconsin</option>
                            </select>
                        </div>

                        <div class="widget">
                            <h2>Type</h2>
                            <select name="" class="form-control select2">
                                <option value="">--- Select ---</option>
                                <option value="">Apartment</option>
                                <option value="">Bungalow</option>
                                <option value="">Cabin</option>
                                <option value="">Condo</option>
                                <option value="">Cottage</option>
                                <option value="">Duplex</option>
                                <option value="">Townhouse</option>
                                <option value="">Villa</option>
                            </select>
                        </div>

                        <div class="widget">
                            <h2>Status</h2>
                            <select name="" class="form-control select2">
                                <option value="">--- Select ---</option>
                                <option value="">For Rent</option>
                                <option value="">For Sale</option>
                            </select>
                        </div>

                        <div class="widget">
                            <h2>Amenities</h2>
                            <select name="" class="form-control select2">
                                <option value="">--- Select ---</option>
                                <option value="">Free Wifi</option>
                                <option value="">Swimming Pool</option>
                                <option value="">Car Parking</option>
                                <option value="">Air Conditioning</option>
                                <option value="">Kitchen</option>
                                <option value="">Gym and Fitness Center</option>
                            </select>
                        </div>

                        <div class="widget">
                            <h2>Bedrooms</h2>
                            <select name="" class="form-control select2">
                                <option value="">--- Select ---</option>
                                <option value="">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                                <option value="">4</option>
                                <option value="">5</option>
                                <option value="">6</option>
                                <option value="">7</option>
                                <option value="">8</option>
                                <option value="">9</option>
                                <option value="">10</option>
                            </select>
                        </div>

                        <div class="widget">
                            <h2>Bathrooms</h2>
                            <select name="" class="form-control select2">
                                <option value="">--- Select ---</option>
                                <option value="">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                                <option value="">4</option>
                                <option value="">5</option>
                                <option value="">6</option>
                                <option value="">7</option>
                                <option value="">8</option>
                                <option value="">9</option>
                                <option value="">10</option>
                            </select>
                        </div>

                        <div class="widget">
                            <h2>Min Price</h2>
                            <select name="" class="form-control select2">
                                <option value="">--- Select ---</option>
                                <option value="">500</option>
                                <option value="">1000</option>
                                <option value="">2000</option>
                                <option value="">3000</option>
                                <option value="">5000</option>
                                <option value="">10000</option>
                            </select>
                        </div>

                        <div class="widget">
                            <h2>Max Price</h2>
                            <select name="" class="form-control select2">
                                <option value="">--- Select ---</option>
                                <option value="">500</option>
                                <option value="">1000</option>
                                <option value="">2000</option>
                                <option value="">3000</option>
                                <option value="">5000</option>
                                <option value="">10000</option>
                            </select>
                        </div>

                        <div class="filter-button">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="property">
                        <div class="container">
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
                                                    <i class="fas fa-map-marker-alt"></i> 2006 E Central Blvd, Orlando FL 32803
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
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="item">
                                        <div class="photo">
                                            <img class="main" src="uploads/property3.jpg" alt="">
                                            <div class="top">
                                                <div class="status-sale">
                                                    For Sale
                                                </div>
                                            </div>
                                            <div class="price">$79,000</div>
                                            <div class="wishlist"><a href=""><i class="far fa-heart"></i></a></div>
                                        </div>
                                        <div class="text">
                                            <h3><a href="property.html">Home with Swimming Pool</a></h3>
                                            <div class="detail">
                                                <div class="stat">
                                                    <div class="i1">2500 sqft</div>
                                                    <div class="i2">2 Bed</div>
                                                    <div class="i3">2 Bath</div>
                                                </div>
                                                <div class="address">
                                                    <i class="fas fa-map-marker-alt"></i> 3152 Plaza Terrace, Orlando FL 32803
                                                </div>
                                                <div class="type-location">
                                                    <div class="i1">
                                                        <i class="fas fa-edit"></i> Apartment
                                                    </div>
                                                    <div class="i2">
                                                        <i class="fas fa-location-arrow"></i> New York
                                                    </div>
                                                </div>
                                                <div class="agent-section">
                                                    <img class="agent-photo" src="uploads/agent3.jpg" alt="">
                                                    <a href="">Brent Grundy (CC Property)</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="item">
                                        <div class="photo">
                                            <img class="main" src="uploads/property4.jpg" alt="">
                                            <div class="top">
                                                <div class="status-sale">
                                                    For Sale
                                                </div>
                                            </div>
                                            <div class="price">$79,000</div>
                                            <div class="wishlist"><a href=""><i class="far fa-heart"></i></a></div>
                                        </div>
                                        <div class="text">
                                            <h3><a href="property.html">Apartment in New York</a></h3>
                                            <div class="detail">
                                                <div class="stat">
                                                    <div class="i1">2500 sqft</div>
                                                    <div class="i2">2 Bed</div>
                                                    <div class="i3">2 Bath</div>
                                                </div>
                                                <div class="address">
                                                    <i class="fas fa-map-marker-alt"></i> 3152 Plaza Terrace, Orlando FL 32803
                                                </div>
                                                <div class="type-location">
                                                    <div class="i1">
                                                        <i class="fas fa-edit"></i> Apartment
                                                    </div>
                                                    <div class="i2">
                                                        <i class="fas fa-location-arrow"></i> New York
                                                    </div>
                                                </div>
                                                <div class="agent-section">
                                                    <img class="agent-photo" src="uploads/agent4.jpg" alt="">
                                                    <a href="">Jason Schwartz (DD Property)</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="item">
                                        <div class="photo">
                                            <img class="main" src="uploads/property5.jpg" alt="">
                                            <div class="top">
                                                <div class="status-sale">
                                                    For Sale
                                                </div>
                                            </div>
                                            <div class="price">$79,000</div>
                                            <div class="wishlist"><a href=""><i class="far fa-heart"></i></a></div>
                                        </div>
                                        <div class="text">
                                            <h3><a href="property.html">Nice Condo in Orlando</a></h3>
                                            <div class="detail">
                                                <div class="stat">
                                                    <div class="i1">2500 sqft</div>
                                                    <div class="i2">2 Bed</div>
                                                    <div class="i3">2 Bath</div>
                                                </div>
                                                <div class="address">
                                                    <i class="fas fa-map-marker-alt"></i> 3152 Plaza Terrace, Orlando FL 32803
                                                </div>
                                                <div class="type-location">
                                                    <div class="i1">
                                                        <i class="fas fa-edit"></i> Apartment
                                                    </div>
                                                    <div class="i2">
                                                        <i class="fas fa-location-arrow"></i> New York
                                                    </div>
                                                </div>
                                                <div class="agent-section">
                                                    <img class="agent-photo" src="uploads/agent5.jpg" alt="">
                                                    <a href="">Michael Wyatt (EE Property)</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="item">
                                        <div class="photo">
                                            <img class="main" src="uploads/property6.jpg" alt="">
                                            <div class="top">
                                                <div class="status-sale">
                                                    For Sale
                                                </div>
                                            </div>
                                            <div class="price">$79,000</div>
                                            <div class="wishlist"><a href=""><i class="far fa-heart"></i></a></div>
                                        </div>
                                        <div class="text">
                                            <h3><a href="property.html">Nice Villa in Boston</a></h3>
                                            <div class="detail">
                                                <div class="stat">
                                                    <div class="i1">2500 sqft</div>
                                                    <div class="i2">2 Bed</div>
                                                    <div class="i3">2 Bath</div>
                                                </div>
                                                <div class="address">
                                                    <i class="fas fa-map-marker-alt"></i> 3152 Plaza Terrace, Orlando FL 32803
                                                </div>
                                                <div class="type-location">
                                                    <div class="i1">
                                                        <i class="fas fa-edit"></i> Apartment
                                                    </div>
                                                    <div class="i2">
                                                        <i class="fas fa-location-arrow"></i> New York
                                                    </div>
                                                </div>
                                                <div class="agent-section">
                                                    <img class="agent-photo" src="uploads/agent6.jpg" alt="">
                                                    <a href="">Joshua Lash (FF Property)</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @endsection   