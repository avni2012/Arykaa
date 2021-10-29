@extends('layouts.backend.master')

@section('title', 'Profile')

@section('breadcrumb-title', 'Profile')

@section('breadcrumb-item')
<li class="breadcrumb-item active">Profile</li>
@endsection

@section('css')
@endsection

@section('style')
@endsection

@section('content')
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Profile</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a>Profile</a></li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      @if(session()->has('message.level'))
          <div class="alert alert-{{ session('message.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('message.content') }}
            <?php Session::forget('message')?>
          </div>
      @endif
      <!-- Main content -->
      <section class="content ">
        <div class="container-fluid">
          <div class="manage_staff_page ">
            <div class="row">
              <div class="col-sm-8">
                <div class="card">
                  <!-- /.card-header -->
                  <div class="card-header">
                    <h6>Change Profile</h6>
                  </div>
                  <div class="card-body">
                    <form name="profile-update" id="profile-update" action="{{route('profile-update')}}" method="Post">
                        <div class="form-group ">@csrf
                          <label class="form-label">Name</label><span class="text-danger">*</span>
                          <input type="text" name="username" class="form-control" value="{{old('username',Auth::guard()->user()->username)}}">
                          @if ($errors->has('username'))
                            <span class="text-danger">{{ $errors->first('username') }}</span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="form-label">Email Id</label><span class="text-danger">*</span>
                          <input type="text" name="email" class="form-control" value="{{old('email',Auth::guard()->user()->email)}}" readonly="true">
                          @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="form-label">Mobile No</label><span class="text-danger">*</span>
                          <input type="text" name="mobile_no" class="form-control" value="{{old('mobile_no',Auth::guard()->user()->mobile_no)}}">
                          @if ($errors->has('mobile_no'))
                            <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="form-label">Role</label>
                          <input class="form-control" value="{{Auth::guard()->user()->roles->first()->name }}" type="text"/ readonly="true">
                        </div>
                        <div class="text-center">
                          <button type="submit" class="btn btn-purple" form="profile-update">Profile Update</button>
                          <a href="{{route('admin.dashboard')}}" class="btn btn-default">Cancel</a>
                        </div>
                  </form>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <div class="col-sm-4">
                <div class="card">
                  <div class="card-header">
                    <h6>Change Password</h6>
                  </div>
                  <div class="card-body">
                    <form action="{{route('change-password')}}" method="post">
                       <div class="form-group">@csrf
                        <label class="form-label">Current Password</label><span class="text-danger">*</span>
                        <input type="password" name="current_password" class="form-control" value="{{old('current_password')}}">
                        @if ($errors->has('current_password'))
                          <span class="text-danger">{{ $errors->first('current_password') }}</span>
                        @endif
                      </div>
                      <div class="form-group">
                        <label class="form-label">Password</label><span class="text-danger">*</span>
                        <input type="password" name="new_password" class="form-control">
                        @if ($errors->has('new_password'))
                          <span class="text-danger">{{ $errors->first('new_password') }}</span>
                        @endif
                      </div>
                      <div class="form-group">
                        <label class="form-label">Confirm Password</label><span class="text-danger">*</span>
                        <input type="password" name="new_confirm_password" class="form-control" >
                        @if ($errors->has('new_confirm_password'))
                          <span class="text-danger">{{ $errors->first('new_confirm_password') }}</span>
                        @endif
                      </div>
                      <div class="col-sm-12 text-center">
                          <button type="submit" class="btn btn-purple">Change Password</button>
                          <a href="{{route('admin.dashboard')}}" class="btn btn-default">Cancel</a>
                      </div>

                  </div>
                </div>
              </div>
              <!-- /.col -->
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
  </div>
@endsection

@section('script-js-last')
@endsection

@section('script')
<!-- page script -->
<script>
</script>
@endsection

