@extends('layouts.backend.master')

@section('title', 'Update Staff')

@section('breadcrumb-title', 'Update Datatable')

@section('breadcrumb-item')
<li class="breadcrumb-item active">Update Datatable</li>
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
              <h1>Update Staff</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('manage-staff.index')}}">Manage Staff</a></li>
                <li class="breadcrumb-item active">Update Staff</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content ">
        <div class="container-fluid">
          <div class="manage_staff_page ">
            <div class="row">
              <div class="col-sm-8">
                <div class="card">
                  <!-- /.card-header -->
                  <div class="card-body">
                    <form name="staff-update" id="staff-update" action="{{route('manage-staff.update',$user->id)}}" method="Post">
                      @csrf
                      {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label class="form-label">Name</label><span class="text-danger">*</span>
                            <input type="text" name="name" class="form-control"
                            value="{{old('name',$user->name)}}">
                            @if ($errors->has('name'))
                              <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email Id</label><span class="text-danger">*</span>
                            <input type="text" name="email" class="form-control" value="{{old('email',$user->email)}}">
                            @if ($errors->has('email'))
                              <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                            @if(session()->has('message-email'))
                            <span class="text-danger">
                                {{ session()->get('message-email') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Mobile No</label><span class="text-danger">*</span>
                            <input type="text" name="mobile_no" class="form-control" value="{{old('mobile_no',$user->mobile_no)}}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                            @if ($errors->has('mobile_no'))
                              <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Assign Roles</label><span class="text-danger">*</span>
                            <select class="form-control"  name="role" id="role">
                                    <option value="">Select Role</option>
                                    @if(count($roles) > 0)
                                      @foreach($roles as $role)
                                        <option value="{{ $role->id}}" @if(old('role',$user->roleUser->role_id) == $role->id) selected @endif >{{$role->display_name}}</option>
                                      @endforeach
                                    @endif
                            </select>
                            @if ($errors->has('role'))
                              <span class="text-danger">{{ $errors->first('role') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                          <label class="form-label">Vendors</label><span class="text-danger">*</span>
                          <select class="form-control" name="vendor_id" id="vendor">
                            <option value="">Select Vendor</option>
                            @if(count($vendors) > 0)
                              @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id}}" @if(old('vendor_id',$vendor->id) == $user->vendor_id) selected @endif>{{$vendor->name}}</option>
                              @endforeach
                            @endif
                          </select>
                          @if ($errors->has('vendor'))
                            <span class="text-danger">{{ $errors->first('vendor') }}</span>
                          @endif
                        </div>
                        <div class="form-group password_field">
                            <label class="form-label">Password</label>
                            <input type="password" id="password-field" name="password" class="form-control" value="">
                            @if ($errors->has('password'))
                              <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group password_field">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" id="password-field" name="password_confirmation" class="form-control" value="">
                            @if ($errors->has('password_confirmation'))
                              <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    </form>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <div class=col-sm-4>
                <div class="card">
                  <div class="card-header">
                    Save
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                          <label class="form-label">Status</label><span class="text-danger">*</span>
                          <select class="form-control" name="status" form="staff-update">
                            <option value="">Select Status</option>
                            <option value="1" @if(old('status',$user->status) == 1)selected @endif >Active</option>
                            <option value="0" @if(old('status',$user->status) == 0)selected @endif >InActive</option>
                          </select>
                           @if ($errors->has('status'))
                            <span class="text-danger">{{ $errors->first('status') }}</span>
                          @endif
                    </div>
                    <div class="row">
                      <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-purple" form="staff-update">Update Staff</button>
                        <a href="{{route('manage-staff.index')}}" class="btn btn-default">Cancel</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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

@endsection

