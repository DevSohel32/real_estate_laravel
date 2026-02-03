@extends('admin.layouts.master')

@section('content')
    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <div>
                    <h1>Customer Management</h1>
                </div>
                <div class="ml-auto">
                    <a href="{{ route('admin_customer_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add
                        Customer</a>
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
                                                <th>photo</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                    
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customers as $customer)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><img src="{{ asset('uploads/' . $customer->photo) }}" alt=""
                                                            class="w_100"></td>
                                                    <td>{{ $customer->name }}</td>
                                                    <td>{{ $customer->email }}</td>
                                                  @if($customer->status == 0)
                                                    <td><span class="badge bg-warning text-dark">Pending</span></td>
                                                @elseif($customer->status == 1)
                                                    <td><span class="badge bg-success">Active</span></td>
                                                @else
                                                    <td><span class="badge bg-danger">Suspended</span></td>
                                                @endif

                                                    <td class="pt_10 pb_10">
                                                        <a href="{{ route('admin_customer_edit', ['id' => $customer->id]) }}"
                                                            class="btn btn-primary"><i class="fas fa-edit"></i></a>


                                                        <form
                                                            action="{{ route('admin_customer_deleted', ['id' => $customer->id]) }}"
                                                            method="POST" id="delete-form-{{ $customer->id }}"
                                                            style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger"
                                                                onclick="confirmDelete({{ $customer->id }})">
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
