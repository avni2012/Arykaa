@extends('layouts.backend.authentication')
@section('content')
<div class="login_page">
    <div class="flash-message">
        @if(session()->has('message.level'))
            <div class="alert alert-{{ session('message.level') }}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('message.content') }}
                <?php Session::forget('message')?>
            </div>
        @endif
    </div>
    <div class="login_page_inner">
        <form method="POST" action="{{ route('admin.login') }}" data-parsley-validate>
            @csrf
            <div class="image_top">
                <img src="{{asset('backend/dist/img/user-img.png')}}">
            </div>
            <h4 class="my-3 text-center">Admin Login</h4>
            <div class="input_area">
                <div class="username">
                    <div class="form-group">
                        <i class="far fa-user"></i>
                        <input type="text" placeholder="Username" name="email" required class="form-control mb-2">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>
                <div class="password">
                    <div class="form-group">
                        <i class="fas fa-lock"></i>
                        <!-- <ion-icon name="lock-closed-outline"></ion-icon> -->
                        <input type="password" placeholder="Password" name="password" required class="form-control mb-2">
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="remember_forgot my-2">
                <div>
                    <label class="container_chk">Remember me
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div>
                    <!-- <a href="#">Forgot Password ?</a> -->
                    @if (Route::has('admin.password.request'))
                        <a class="btn btn-link" href="{{ route('admin.password.request') }}">
                            {{ __('Forgot Password?') }}</a>
                    @endif
                </div>
            </div>
            <button type="submit" class="login_btn btn btn-primary">Login</button>
        </form>
    </div>
</div>
<footer class="main-footer">
    Powered By <a href="#">Sassy Infotech Pvt. Ltd.</a>
</footer>
@endsection
@section('jssection')
@endsection
