@extends('admin.layouts.master')

@section('content')
    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <div>
                    <h1>Location</h1>
                </div>
                <div class="ml-auto">
                    <a href="{{ route('admin_location_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add
                        Location</a>
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
                                                <th>slug</th>
                                                <th>Total Properties</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($locations as $location)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><img src="{{ asset('uploads/' . $location->photo) }}" alt=""
                                                            class="w_200"></td>
                                                    <td>{{ $location->name }}</td>
                                                    <td>{{ $location->slug }}</td>
                                                    <td>{{ $location->total_properties }}</td>
                                                    <td class="pt_10 pb_10">
                                                        <a href="{{ route('admin_location_edit', ['id' => $location->id]) }}"
                                                            class="btn btn-primary"><i class="fas fa-edit"></i></a>


                                                        <form
                                                            action="{{ route('admin_location_deleted', ['id' => $location->id]) }}"
                                                            method="POST" id="delete-form-{{ $location->id }}"
                                                            style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger"
                                                                onclick="confirmDelete({{ $location->id }})">
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
<script>
    function confirmDelete(id) {
        iziToast.question({
            timeout: 20000,
            close: false,
            overlay: true,
            displayMode: 'once',
            id: 'question',
            zindex: 999,
            title: 'Wait!',
            message: 'Are you sure you want to delete this package?',
            position: 'center',
            buttons: [
                ['<button><b>YES</b></button>', function (instance, toast) {
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    document.getElementById('delete-form-' + id).submit();
                }, true],
                ['<button>NO</button>', function (instance, toast) {
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                }],
            ],
        });
    }
</script>