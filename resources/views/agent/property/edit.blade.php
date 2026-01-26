@extends('front.layouts.master')

@section('content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Edit Property</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content user-panel">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    @include('agent.sidebar.index')
                </div>
                <div class="col-lg-9 col-md-12">
                    <form action="{{ route('agent_property_update', $property->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{ $property->id }}">
                        <div class="row">
                            {{-- Basic Information --}}
                            <div class="col-md-4 mb-3">
                                <label for="" class="form-label">Title *</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $property->name) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="" class="form-label">Slug *</label>
                                <input type="text" name="slug" class="form-control" value="{{ old('slug', $property->slug) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="" class="form-label">Price *</label>
                                <input type="text" name="price" class="form-control" value="{{ old('price', $property->price) }}">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="" class="form-label">Description</label>
                                <textarea name="description" class="form-control editor" cols="30" rows="10">{{ old('description', $property->description) }}</textarea>
                            </div>

                            {{-- Category & Type --}}
                            <div class="col-md-4 mb-3">
                                <label for="location_id" class="form-label">Location *</label>
                                <select name="location_id" class="form-control select2">
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}" {{ $location->id == $property->location_id ? 'selected' : '' }}>
                                            {{ $location->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="type_id" class="form-label">Type *</label>
                                <select name="type_id" class="form-control select2">
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}" {{ $type->id == $property->type_id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="purpose" class="form-label">Purpose *</label>
                                <select name="purpose" class="form-control select2">
                                    <option value="For Sale" {{ $property->purpose == 'For Sale' ? 'selected' : '' }}>For Sale</option>
                                    <option value="For Rent" {{ $property->purpose == 'For Rent' ? 'selected' : '' }}>For Rent</option>
                                </select>
                            </div>

                            {{-- Property Details --}}
                            <div class="col-md-4 mb-3">
                                <label for="bedroom" class="form-label">Bedrooms</label>
                                <select name="bedroom" class="form-control select2">
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ $i == $property->bedroom ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="bathroom" class="form-label">Bathrooms</label>
                                <select name="bathroom" class="form-control select2">
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ $i == $property->bathroom ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="size" class="form-label">Size (Sqft)</label>
                                <input type="text" name="size" class="form-control" value="{{ old('size', $property->size) }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="floor" class="form-label">Floor</label>
                                <input type="text" name="floor" class="form-control" value="{{ old('floor', $property->floor) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="garage" class="form-label">Garage</label>
                                <input type="text" name="garage" class="form-control" value="{{ old('garage', $property->garage) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="balcony" class="form-label">Balcony</label>
                                <input type="text" name="balcony" class="form-control" value="{{ old('balcony', $property->balcony) }}">
                            </div>

                            <div class="col-md-8 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" value="{{ old('address', $property->address) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="built_year" class="form-label">Built Year</label>
                                <input type="text" name="built_year" class="form-control" value="{{ old('built_year', $property->built_year) }}">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="map" class="form-label">Location Map (Iframe Code)</label>
                                <textarea name="map" class="form-control h-150" cols="30" rows="10">{{ old('map', $property->map) }}</textarea>
                            </div>

                            {{-- Amenities --}}
                            <div class="col-md-12 mb-3">
                                <label for="" class="form-label">Amenities</label>
                                <div class="row">
                                    @php $existing_amenities = explode(',', $property->amenities); @endphp
                                    @foreach ($amenities as $amenity)
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $amenity->name }}"
                                                    name="amenities[]" id="amenity{{ $amenity->id }}"
                                                    {{ in_array($amenity->name, $existing_amenities) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="amenity{{ $amenity->id }}">
                                                    {{ $amenity->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Photo --}}
                            <div class="col-md-6 mb-3">
                                <label for="featured_photo" class="form-label">Featured Photo</label>
                                <div class="mb-2">
                                    <img src="{{ asset('uploads/'.$property->featured_photo) }}" id="showImage" alt="Preview"
                                        class="w-200 h-150" style="border: 1px solid #ddd; object-fit: cover;">
                                </div>
                                <input type="file" name="featured_photo" id="image" class="form-control">
                            </div>

                            <div class="col-md-12 mb-3">
                                <input type="submit" class="btn btn-primary" value="Update Property" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
@endsection