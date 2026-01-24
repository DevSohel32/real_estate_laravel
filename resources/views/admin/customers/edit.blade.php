@extends('admin.layouts.master')

@section('content')
    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')
    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit Customer</h1>
                <div class="ml-auto">
                    <a href="{{ route('admin_customers_index') }}" class="btn btn-primary"><i class="fas fa-eye"></i> View All</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin_customer_update', $customer->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $customer->id }}">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img src="{{ $customer->photo ? asset('uploads/'.$customer->photo) : asset('uploads/default.png') }}" 
                                                 id="showImage" alt="Profile Photo" class="profile-photo w_100_p h_300">
                                            <input type="file" class="mt_10" name="photo" id="image">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="mb-4">
                                                <label class="form-label">Name *</label>
                                                <input type="text" class="form-control" name="name" value="{{ $customer->name }}">
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">Email *</label>
                                                <input type="text" class="form-control" name="email" value="{{ $customer->email }}">
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="1" {{ $customer->status == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ $customer->status == 0 ? 'selected' : '' }}>Pending</option>
                                                    <option value="2" {{ $customer->status == 2 ? 'selected' : '' }}>Suspended</option>
                                                </select>
                                            </div>
                                            <div class="mb-4">
                                                <button type="submit" class="btn btn-primary">Update Customer</button>
                                            </div>
                                        </div>
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