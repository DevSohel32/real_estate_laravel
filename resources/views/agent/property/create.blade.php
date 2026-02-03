@extends('front.layouts.master')

@section('content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Add Property</h2>
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
                    <div class="col-lg-9 col-md-12">
                        <form action="{{ route('agent_property_store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                {{-- Basic Information --}}
                                <div class="col-md-4 mb-3">
                                    <label for="" class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="Property Title"
                                        value="{{ old('name') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="" class="form-label">Slug <span class="text-danger">*</span></label>
                                    <input type="text" name="slug" class="form-control" placeholder="property-slug"
                                        value="{{ old('slug') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="" class="form-label">Price <span class="text-danger">*</span></label>
                                    <input type="text" name="price" class="form-control" placeholder="Price" value="{{ old('price') }}">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="" class="form-label">Description</label>
                                    <textarea name="description" class="form-control editor" cols="30" rows="10" value="{{ old('description') }}"></textarea>
                                </div>

                                {{-- Category & Type --}}
                                <div class="col-md-4 mb-3">
                                    <label for="location_id" class="form-label">Location <span class="text-danger">*</span></label>
                                    <select name="location_id" class="form-control select2" value="{{ old('') }}">
                                        <option value="">--- Select Location ---</option>
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="type_id" class="form-label">Type <span class="text-danger">*</span></label>
                                    <select name="type_id" class="form-control select2" value="{{ old('') }}">
                                        <option value="">--- Select ---</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="purpose" class="form-label">Purpose <span class="text-danger">*</span></label>
                                    <select name="purpose" class="form-control select2" value="{{ old('') }}">
                                        <option value="">--- Select ---</option>
                                        <option value="Sale">Sale</option>
                                        <option value="Rent">Rent</option>
                                    </select>
                                </div>

                                {{-- Property Details --}}
                                <div class="col-md-4 mb-3">
                                    <label for="bedroom" class="form-label">Bedrooms<span class="text-danger">*</span></label>
                                   <input type="number" name="bedroom" class="form-control" value="{{ old('bedroom') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="bathroom" class="form-label">Bathrooms <span class="text-danger">*</span></label>
                                    <input type="number" name="bathroom" class="form-control" value="{{ old('bathroom') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="size" class="form-label">Size (Sqft)</label>
                                    <input type="text" name="size" class="form-control" value="{{ old('size') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="floor" class="form-label">Floor</label>
                                    <input type="text" name="floor" class="form-control" value="{{ old('floor') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="garage" class="form-label">Garage</label>
                                    <input type="text" name="garage" class="form-control" value="{{ old('garage') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="balcony" class="form-label">Balcony</label>
                                    <input type="text" name="balcony" class="form-control" value="{{ old('balcony') }}">
                                </div>

                                <div class="col-md-8 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="built_year" class="form-label">Built Year</label>
                                    <input type="text" name="built_year" class="form-control" value="{{ old('built_year') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="is_featured" class="form-label">is_featured</label>
                                    <select name="is_featured" class="form-control select2">
                                        <option value="Yes">Yes</option><option value="No">NO</option>
                                        
                                    </select>
                                </div>
                        
                                <div class="col-md-12 mb-3">
                                    <label for="map" class="form-label">Location Map (Iframe Code)</label>
                                    <textarea name="map" class="form-control h-150" cols="30" rows="10"></textarea>
                                </div>
                                 

                                {{-- Amenities (Checkboxes) --}}
                                <div class="col-md-12 mb-3">
                                    <label for="" class="form-label">Amenities</label>
                                    <div class="row">
                                        @foreach ($amenities as $amenity)
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="{{ $amenity->name }}"
                                                        name="amenities[]" id="amenity{{ $amenity->id }}">
                                                    <label class="form-check-label" for="amenity{{ $amenity->id }}">
                                                        {{ $amenity->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Featured Photo & Preview --}}
                                <div class="col-md-6 mb-3">
                                    <label for="featured_photo" class="form-label">Featured Photo <span class="text-danger">*</span></label>
                                    <div class="mb-2">
                                        <img src="{{ asset('uploads/default.png') }}" id="showImage" alt="Preview"
                                            class="w-200 h-150" style="border: 1px solid #ddd; object-fit: cover;">
                                    </div>
                                    <input type="file" name="featured_photo" id="image" class="form-control" value="{{ old('') }}">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <input type="submit" class="btn btn-primary" value="Submit Property" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.querySelector('input[name="name"]');
    const slugInput = document.querySelector('input[name="slug"]');

    if (nameInput && slugInput) {
        nameInput.addEventListener('keyup', function() {
            let name = this.value;
            let slug = name.toLowerCase()
                           .replace(/ /g, '-')          
                           .replace(/[^\w-]+/g, '')     
                           .replace(/-+$/, '');         

            slugInput.value = slug;
        });
    }
});

$(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>