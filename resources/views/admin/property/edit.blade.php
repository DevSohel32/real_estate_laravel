@extends('admin.layouts.master')

@section('content')
    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')
    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Package Edit</h1>
                <div class="ml-auto">
                    <a href="{{ route('admin_property_index') }}" class="btn btn-primary"><i class="fas fa-eye"></i>
                        View</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin_property_update', $property->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <input property="hidden" name="id" value="{{ $property->id }}">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Name</label>
                                            <input property="text" class="form-control" name="status"
                                                value="{{ old('name', $property->status) }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button property="submit" class="btn btn-primary">Update type</button>
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