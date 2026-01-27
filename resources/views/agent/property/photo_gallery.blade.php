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
                    <h4>Add Photo</h4>
                    <form action="{{ route('agent_property_photo_gallery_store', ['id' => $property->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <input type="file" name="photo" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-sm" value="Submit" />
                            </div>
                        </div>
                    </form>

                    <h4 class="mt-4">Existing Photos</h4>
                    <div class="photo-all">
                        <div class="row">
                            @foreach ($photos as $item)
                                <div class="col-md-6 col-lg-3">
                                    <div class="item item-delete">
                                        <a href="{{ asset('uploads/' . $item->photo)}}" class="magnific">
                                            <img src="{{ asset('uploads/' . $item->photo)}}" alt="" />
                                            <div class="icon">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                            <div class="bg"></div>
                                        </a>
                                    </div>
                                    <a href="javascript:void(0);" class="badge bg-danger mb_20"
                                        onClick="confirmDelete({{ $item->id }})">Delete</a>

                                    <form id="delete-form-{{ $item->id }}"
                                        action="{{ route('agent_property_photo_gallery_delete', $item->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection