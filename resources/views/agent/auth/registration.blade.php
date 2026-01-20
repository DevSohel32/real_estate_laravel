@extends('front.layouts.master')
@section('content')
    <div class="page-top" style="background-image: url('{{ asset('uploads/banner.jpg') }}')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Agent Registration</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                    <div class="login-form">
                        <form action="{{ route('agent_registration_submit') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for=""> Name </label>
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for=""> Email </label>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                </div>
                                    <div class="col-md-6 mb-3">
                                    <label for="">Company</label>
                                    <div class="form-group">
                                        <input type="text" name="company" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Designation</label>
                                    <div class="form-group">
                                        <input type="text" name="designation" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Password</label>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Confirm Password</label>
                                    <div class="form-group">
                                        <input type="password" name="confirm_password" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Create Account">
                                    </div>
                                </div>
                                 <div class="">
                                <a href="{{ route('agent_login') }}" class="primary-color">Existing Agent? Login Now</a>
                            </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
