@extends('layouts.backend.authentication')
@section('content')

    <div class="login_page reset_password_page">
        <div class="login_page_inner reset_password_page_inner">

            <form method="POST" action="{{ route('admin.password.email') }}" data-parsley-validate>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @csrf

                <div class="image_top d-none">
                    <img src="{{asset('assets/backend/dist/img/user-img.png')}}">
                </div>
                <h4 class="my-3 text-center">Forgot Password</h4>
                <div class="input_area">
                    <div class="username">
                        <label>E-Mail Address</label>
                        <div class="form-group">
                            <i class="far fa-envelope">

                            </i>
                            <input type="email" placeholder="Email" name="email" required class="form-control mb-2" >
                        </div>
                        @error('email')
                            <span class="invalid-feedback " role="alert" style="display: block;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="login_btn btn btn-primary mb-2"> {{ __('Send Password Reset Link') }}</button>
                <div class="my-2">
                    <a href="{{ route('admin.login') }}" class="goto_login ">
                        <i class="fas fa-chevron-left mr-2">
                        </i> Go To Login </a>
                </div>
            </form>
        </div>
    </div>
    <footer class="main-footer">
        Powered By <a href="#">Sassy Infotech Pvt. Ltd.</a>
    </footer>
@endsection
