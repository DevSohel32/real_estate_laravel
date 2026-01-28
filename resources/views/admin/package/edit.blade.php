@extends('admin.layouts.master')

@section('content')
    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')
    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Package Edit</h1>
                <div class="ml-auto">
                    <a href="" class="btn btn-primary"><i class="fas fa-plus"></i> Button</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin_package_update') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="id" value="{{ $package->id }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name" value="{{ old('name',$package->name) }}">
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Price</label>
                                                <input type="text" class="form-control" name="price" value="{{ old('price',$package->price) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Allowed Days</label>
                                                <input type="text" class="form-control" name="allowed_days"  value="{{ old('allowed_days',$package->allowed_days) }}">
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Allowed Properties</label>
                                                <input type="text" class="form-control" name="allowed_properties" value="{{ old('allowed_properties',$package->allowed_properties) }}">
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>Allowed Featured Properties</label>
                                                <input type="text" class="form-control" name="allowed_featured_properties"  value="{{ old('allowed_featured_properties',$package->allowed_featured_properties) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>Allowed Photos</label>
                                                <input type="text" class="form-control" name="allowed_photos"  value="{{ old('allowed_photos',$package->allowed_photos) }}">
                                            </div>
                                        </div>
                                         <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>Allowed Videos</label>
                                                <input type="text" class="form-control" name="allowed_videos" value="{{ old('allowed_videos',$package->allowed_videos) }}">
                                            </div>
                                        </div>
                                        </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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