@extends('front.layouts.master')
@section('content')
    <div class="page-top" style="background-image: url('uploads/banner.jpg')">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Forget Password</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                    <div class="login-form">
                        <form action="{{ route('forget_password_submit') }}" method="post">
                            @csrf
                           
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary bg-website">
                                   Submit
                                </button>

                            </div>
                        </form>
                        <div class="mb-3">

                            <a href="{{ route('login') }}" class="primary-color">Back to Login Page</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


{{-- <form action="{{ route('forget_password_submit') }}" method="post">
    @csrf
    <table>
        <tr>
            <td>Email:</td>
            <td>
                <input type="text" name="email" placeholder="Email">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit">Submit</button>
                <div>
                    <a href="{{ route('login') }}">Back to Login Page</a>
                </div>
            </td>
        </tr>
    </table>
</form> --}}