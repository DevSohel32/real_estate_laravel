@extends('admin.layouts.master')

@section('content')
    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <div>
                    <h1>Packages</h1>
                </div>
                <div class="ml-auto">
                    <a href="{{ route('admin_package_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add
                        Package</a>
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
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Allowed Days</th>
                                                <th>Allowed Properties</th>
                                                <th>Allowed Featured Properties</th>
                                                <th>Allowed Featured Photos</th>
                                                <th>Allowed Featured Video</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($packages as $package)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $package->name }}</td>
                                                    <td>${{ $package->price }}</td>
                                                    <td>
                                                        {{ $package->allowed_days == -1 ? 'Unlimited' : $package->allowed_days }}
                                                    </td>
                                                    <td>
                                                        {{ $package->allowed_properties == -1 ? 'Unlimited' : $package->allowed_properties }}
                                                    </td>
                                                    <td>
                                                        {{ $package->allowed_featured_properties == -1 ? 'Unlimited' : $package->allowed_featured_properties }}
                                                    </td>
                                                    <td>
                                                        {{ $package->allowed_photos == -1 ? 'Unlimited' : $package->allowed_photos }}
                                                    </td>

                                                    <td>
                                                        {{ $package->allowed_videos == -1 ? 'Unlimited' : $package->allowed_videos }}
                                                    </td>
                                                    <td class="pt_10 pb_10">
                                                        <a href="{{ route('admin_package_edit', ['id' => $package->id]) }}"
                                                            class="btn btn-primary"><i class="fas fa-edit"></i></a>


                                                        <form action="{{ route('admin_package_deleted', ['id' => $package->id]) }}" 
                                                        method="POST" 
                                                        id="delete-form-{{ $package->id }}"
                                                        style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $package->id }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>


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
