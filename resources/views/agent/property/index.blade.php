@extends('front.layouts.master')

@section('content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Profile Edit</h2>
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
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Feature photo</th>
                                    <th>Name</th>
                                    <th>Agent</th>
                                    <th>Location</th>
                                    <th>Type</th>
                                    <th>Purpose</th>
                                    <th>Status</th>
                                    <th class="w-100">Options</th>
                                    <th class="w-60">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($properties as $property)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset('uploads/' . $property->featured_photo) }}" alt="" class="w-100">
                                        </td>
                                        <td>{{ $property->name }}</td>
                                        <td>{{ $property->agent->name ?? 'N/A' }}</td>
                                        <td>{{ $property->location->name ?? 'N/A' }}</td>
                                        <td>{{ $property->type->name ?? 'N/A' }}</td>

                                        <td>{{ $property->purpose }}</td>
                                        <td>
                                            @if ($property->status == 'Active')
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('agent_property_photo_gallery',['id' => $property->id]) }}" class="btn btn-primary btn-sm w-105 mb-2">Photo
                                                Gallery</a>
                                            <a href="{{ route('agent_property_video_gallery',['id' => $property->id]) }}" class="btn btn-primary btn-sm w-105 mb_5">Video
                                                Gallery</a>
                                        </td>
                                        <td class="pt_10 pb_10">
                                            <a href="{{ route('agent_property_edit', ['id' => $property->id]) }}"
                                                class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>

                                            <form action="{{ route('agent_property_deleted', ['id' => $property->id]) }}"
                                                method="POST" id="delete-form-{{ $property->id }}" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="confirmDelete({{ $property->id }})">
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
@endsection