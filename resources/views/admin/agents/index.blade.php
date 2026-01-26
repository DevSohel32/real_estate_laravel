@extends('admin.layouts.master')

@section('content')
    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <div>
                    <h1>Agent Management</h1>
                </div>
                <div class="ml-auto">
                    <a href="{{ route('admin_agent_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add
                        Agent</a>
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
                                            @foreach ($agents as $agent)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><img src="{{ asset('uploads/' . $agent->photo) }}" alt=""
                                                            class="w_100"></td>
                                                    <td>{{ $agent->name }}</td>
                                                    <td>{{ $agent->email }}</td>
                                                  @if($agent->status == 0)
                                                    <td><span class="badge bg-warning text-dark">Pending</span></td>
                                                @elseif($agent->status == 1)
                                                    <td><span class="badge bg-success">Active</span></td>
                                                @else
                                                    <td><span class="badge bg-danger">Suspended</span></td>
                                                @endif

                                                    <td class="pt_10 pb_10">
                                                        <a href="{{ route('admin_agent_edit', ['id' => $agent->id]) }}"
                                                            class="btn btn-primary"><i class="fas fa-edit"></i></a>


                                                        <form
                                                            action="{{ route('admin_agent_deleted', ['id' => $agent->id]) }}"
                                                            method="POST" id="delete-form-{{ $agent->id }}"
                                                            style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger"
                                                                onclick="confirmDelete({{ $agent->id }})">
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