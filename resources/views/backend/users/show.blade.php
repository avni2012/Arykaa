@extends('layouts.backend.master')

@section('title', 'Edit Customer')

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
                            <h1>Edit Customer</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('manage-users.index') }}">Manage Customer</a></li>
                                <li class="breadcrumb-item active">Edit Customer</li>
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
                    <div class="manage_staff_page">
                        <form action=" {{ route('manage-users.update',['manage_user'=> $user->id]) }}" method="POST">
                            @csrf
                            @method("PATCH")
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6>Personal Info</h6>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label class="form-label">First Name</label><span class="text-danger">*</span>
                                                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name',$user->first_name) }}">
                                                    @if ($errors->has('first_name'))
                                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label class="form-label">Last Name</label><span class="text-danger">*</span>
                                                    <input type="text" name="last_name" class="form-control" value="{{old('last_name',$user->last_name)}}">
                                                    @if ($errors->has('last_name'))
                                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label class="form-label">Mobile No</label><span class="text-danger">*</span>
                                                    <input type="text" name="mobile_no" class="form-control" value="{{old('mobile_no',$user->mobile_no)}}">
                                                    @if ($errors->has('mobile_no'))
                                                        <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label class="form-label">Email Id</label><span class="text-danger">*</span>
                                                    <input type="text" name="email" class="form-control" value="{{old('email',$user->email)}}">
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label class="form-label">Date of Birth</label><span class="text-danger">*</span>
                                                    <input type="text" name="dob" id="user-dob" class="form-control" value="{{ old('dob',$user->date_of_birth) }}" readonly>
                                                    @if ($errors->has('dob'))
                                                        <span class="text-danger">{{ $errors->first('dob') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h6>Address</h6>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="form-label">Address Line 1</label><span class="text-danger">*</span>
                                                <input type="text" name="address_line_1" class="form-control" placeholder="House No.,Building name" value="{{ old('address_line_1',$user->addresses->where('is_primary',1)->first()->address_line_1??'' )}}">
                                                @if ($errors->has('address_line_1'))
                                                    <span class="text-danger">{{ $errors->first('address_line_1') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Address Line 2</label><span class="text-danger">*</span>
                                                <input type="text" name="address_line_2" placeholder="Road name,area,colony" class="form-control" value="{{ old('address_line_2',$user->addresses->where('is_primary',1)->first()->address_line_2??'') }}">
                                                @if ($errors->has('address_line_2'))
                                                    <span class="text-danger">{{ $errors->first('address_line_2') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Address Line 3</label>
                                                <input type="text" name="address_line_3" placeholder="Landmark" class="form-control" value="{{ old('address_line_3',$user->addresses->where('is_primary',1)->first()->address_line_3??'')}}">
                                                @if ($errors->has('address_line_3'))
                                                    <span class="text-danger">{{ $errors->first('address_line_3') }}</span>
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label class="form-label">Country</label><span class="text-danger">*</span>
                                                    <select class="form-control country-dropdown" name="country_id" id="country">
                                                        @if( isset($countries) &&  count($countries))
                                                            @foreach( $countries as $country )
                                                                <option value="{{$country->id}}" {{ isset($user->addresses->where('is_primary',1)->first()->country_id) && ($country->id == $user->addresses->where('is_primary',1)->first()->country_id) ? 'selected' : '' }}>{{ $country->name }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                    @if ($errors->has('country_id'))
                                                        <span class="text-danger">{{ $errors->first('country_id') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label class="form-label">State</label><span class="text-danger">*</span>
                                                    <!--state append from ajax request on country change-->
                                                    <input type="hidden" name="user_selected_state_id" id="user_selected_state_id" value="{{ $user->addresses->where('is_primary',1)->first()->state_id??'' }}">
                                                    <select class="form-control state-dropdown" name="state_id" id="state">
                                                        <!--options dynamic-->
                                                    </select>
                                                    @if ( $errors->has('state_id') )
                                                        <span class="text-danger">{{ $errors->first('state_id') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label class="form-label">City</label><span class="text-danger">*</span>
                                                    <input type="hidden" name="user_selected_city_id" id="user_selected_city_id" value="{{ $user->addresses->where('is_primary',1)->first()->city_id??'' }}">
                                                    <!--city append from ajax request on state change-->
                                                    <select class="form-control city-dropdown" name="city_id" id="city">
                                                        <!--options dynamic-->
                                                    </select>
                                                    @if ($errors->has('city_id'))
                                                        <span class="text-danger">{{ $errors->first('city_id') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label class="form-label">Pincode</label><span class="text-danger">*</span>
                                                    <input type="text" name="post_code" class="form-control" value="{{ old('post_code',$user->addresses->where('is_primary',1)->first()->post_code??'') }}">
                                                    @if ($errors->has('post_code'))
                                                        <span class="text-danger">{{ $errors->first('post_code') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6>Update</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-sm-12">
                                                    <label class="form-label">Remarks</label><span class="text-danger">*</span>
                                                    <textarea class="form-control" name="remarks" id="remarks" cols="30">{{old('remarks',$user->remarks)}}</textarea>
                                                    @if ($errors->has('remarks'))
                                                        <span class="text-danger">{{ $errors->first('remarks') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label class="form-label">Status</label><span class="text-danger">*</span>
                                                    <select class="form-control" name="status">
                                                        <option value="1" {{ ($user->status == 1) ? 'selected' : '' }}>Active</option>
                                                        <option value="0" {{ ($user->status == 0) ? 'selected' : '' }} >InActive</option>
                                                    </select>
                                                    @if ($errors->has('status'))
                                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-12 text-center">
                                                    <button type="submit" class="btn btn-purple" >Update</button>
                                                    <a href="{{ route('manage-users.index' )}}" class="btn btn-default">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
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
    <script src="{{ asset('assets/backend/developer/users/users-edit.js') }}"></script>
@endsection

@section('script')
@endsection
