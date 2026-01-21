@extends('admin.layouts.master')

@section('content')
    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')
    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit Type</h1>
                <div class="ml-auto">
                    <a href="{{ route('admin_types_index') }}" class="btn btn-primary"><i class="fas fa-eye"></i> View All</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <form action="{{ route('admin_type_update', $type->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')           
                                <input type="hidden" name="id" value="{{ $type->id }}">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name', $type->name) }}">
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update type</button>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.querySelector('input[name="name"]');
    const slugInput = document.querySelector('input[name="slug"]');

    if (nameInput && slugInput) {
        nameInput.addEventListener('keyup', function() {
            let name = this.value;
            let slug = name.toLowerCase()
                           .replace(/ /g, '-')          
                           .replace(/[^\w-]+/g, '')     
                           .replace(/-+$/, '');         

            slugInput.value = slug;
        });
    }
});
</script>