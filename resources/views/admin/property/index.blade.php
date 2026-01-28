@extends('admin.layouts.master')

@section('content')
    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <div>
                    <h1>Properties</h1>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="example1">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Feature photo</th>
                                                <th>Name</th>
                                                <th>Agent</th>
                                                <th>Location</th>
                                                <th>Type</th>
                                                <th>Purpose</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($properties as $property)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . $property->featured_photo) }}" alt=""
                                                            class="w_100">
                                                    </td>
                                                    <td>{{ $property->name }}</td>
                                                    <td>{{ $property->agent->name ?? 'N/A' }}</td>
                                                    <td>{{ $property->location->name ?? 'N/A' }}</td>
                                                    <td>{{ $property->type->name ?? 'N/A' }}</td>
                                                    <td>{{ $property->purpose }}</td>
                                                    <td>${{ $property->price }}</td>
                                                    <td>
                                                        @if ($property->status == 'Active')
                                                            <span class="badge bg-success">Active</span>
                                                        @else
                                                            <span class="badge bg-danger">Pending</span>
                                                        @endif
                                                    </td>

                                                    <td class="pt_10 pb_10">
                                                        <a href="{{ route('admin_property_details', $property->id) }}"
                                                            class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('admin_property_edit', $property->id) }}"
                                                            class="btn btn-sm btn-success">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection