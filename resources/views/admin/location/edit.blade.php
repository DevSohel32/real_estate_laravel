@extends('admin.layouts.master')

@section('content')
    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')
    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit Location</h1>
                <div class="ml-auto">
                    <a href="{{ route('admin_locations_index') }}" class="btn btn-primary"><i class="fas fa-eye"></i> View All</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <form action="{{ route('admin_location_update', $location->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                
                                <input type="hidden" name="id" value="{{ $location->id }}">

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Current Image</label>
                                            <div class="mb-2">
                                                <img src="{{ asset('uploads/'.$location->photo) }}" alt="" style="width:150px;">
                                            </div>
                                            <input type="file"  name="photo">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name', $location->name) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Slug</label>
                                            <input type="text" class="form-control" name="slug" value="{{ old('slug', $location->slug) }}">
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update Location</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection