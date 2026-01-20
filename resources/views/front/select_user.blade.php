@extends('front.layouts.master')
@section('content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Selected User</h2>
                </div>
            </div>
        </div>
    </div>
   <div class="page-content py-5">
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-md-6 mb-4">
                <div class="card  border text-center p-4 ">
                    <div class="card-body">
                        <div class="mb-3">
                            <i class="fas fa-user-circle fa-4x text-primary"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Customer</h3>
                        <div class="d-grid gap-2">
                            <a href="{{ route('registration') }}" class="btn btn-outline-primary">Customer Registration</a>
                            <a href="{{ route('login') }}" class="btn btn-primary">Customer Login</a>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card  border text-center p-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <i class="fas fa-briefcase fa-4x text-success"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Agent</h3>
                        <div class="d-grid gap-2">
                            <a href="{{ route('agent_registration') }}" class="btn btn-outline-success">Agent Registration</a>
                            <a href="{{ route('agent_login') }}" class="btn btn-success">Agent Login</a>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
<style>
    .card {
        transition: transform 0.8s ease-in-out, box-shadow 0.8s ease-out;
        border-radius: 15px;
    }
    .card:hover {
        transform: translateX(-10px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
    }
    .icon-area i {
        opacity: 0.8;
    }
</style>