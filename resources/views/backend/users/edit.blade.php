@extends('layouts.backend.master')

@section('title', 'Edit User')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/datepicker/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/css/intlTelInput.css') }}">
@endsection

@section('style')
<style type="text/css">
    .iti-flag {
        background-image:url("http://localhost/jobboosts-laravel/public/frontend/images/flags.png");
    }
</style>
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
                            <h1>Edit User</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('manage-users.index') }}">Manage Users</a></li>
                                <li class="breadcrumb-item active">Edit User</li>
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
                        {{--<form action=" {{route('manage-users.update', $user->id) }}" method="POST">--}}
                            <div class="row">
                                 <div class="col-sm-4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <!-- <div class="card-header">
                                                    <h6>Save</h6>
                                                </div> -->
                                                <div class="box box-widget widget-user">
                                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                                    <div class="widget-user-header bg-aqua-active">
                                                      <h3 class="widget-user-username text-left">{{ $user->name }}</h3>
                                                      <h5 class="widget-user-desc text-left"><a href="#">{{ $user->email }}</a></h5>
                                                    </div>
                                                    <div class="widget-user-image">
                                                    @if($user->profile_picture != null)
                                                        <img class="img-circle" src="{{ asset('/frontend/images/user_profiles/'.$user->profile_picture) }}" alt="User Avatar">
                                                    @else
                                                        <img class="img-circle" src="https://adminlte.io/themes/AdminLTE/dist/img/user1-128x128.jpg" alt="User Avatar">
                                                    @endif
                                                    </div>
                                                    <div class="box-footer">
                                                      <div class="row">
                                                        <div class="col-sm-4 border-right">
                                                          <div class="description-block">
                                                            <h5 class="description-header">{{ $user_resumes_count }}</h5>
                                                            <span class="description-text">Resumes</span>
                                                          </div>
                                                          <!-- /.description-block -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-sm-4 border-right">
                                                          <div class="description-block">
                                                            <h5 class="description-header">0</h5>
                                                            <span class="description-text">Covers</span>
                                                          </div>
                                                          <!-- /.description-block -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-sm-4">
                                                          <div class="description-block">
                                                            <h5 class="description-header">0</h5>
                                                            <span class="description-text">Emails</span>
                                                          </div>
                                                          <!-- /.description-block -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <!-- /.col -->
                                                        <div class="col-sm-6 border-right">
                                                          <div class="description-block">
                                                            <h5 class="description-header">0</h5>
                                                            <span class="description-text">Coures</span>
                                                          </div>
                                                          <!-- /.description-block -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-sm-6">
                                                          <div class="description-block">
                                                            <h5 class="description-header">0</h5>
                                                            <span class="description-text">Session</span>
                                                          </div>
                                                          <!-- /.description-block -->
                                                        </div>
                                                        <!-- /.col -->
                                                      </div>
                                                      <!-- /.row -->
                                                    </div>
                                                </div>
                                                <form action=" {{ route('manage-users.update',['manage_user'=> $user->id]) }}" method="POST" id="user-form">
                                                    <div class="card-body">
                                                        @csrf
                                                        {{ method_field('patch') }}
                                                    <div class="row">
                                                        <div class="form-group col-sm-12">
                                                            <label class="form-label">Status</label><span class="text-danger">*</span>
                                                            <select class="form-control" name="status">
                                                                <option value="1" @if($user->status == 1) selected @endif>Active</option>
                                                                <option value="0" @if($user->status == 0) selected @endif>InActive</option>
                                                            </select>
                                                            @if ($errors->has('status'))
                                                                <span class="text-danger">{{ $errors->first('status') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label class="form-label">Email</label><span class="text-danger">*</span>
                                                            <input type="text" name="email" class="form-control" value="{{$user->email ?? old('email')}}">
                                                            @if ($errors->has('email'))
                                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                                            @endif
                                                        </div>       
                                                        <div class="form-group col-sm-12">
                                                            <label class="form-label">Date of Birth</label><span class="text-danger">*</span>
                                                            <div class="input-group date" id="date_of_birth" data-target-input="nearest">
                                                              <input type="text" class="form-control datetimepicker-input" name="date_of_birth" placeholder="Enter date of birth" data-target="#date_of_birth" value="{{$user->date_of_birth ?? old('date_of_birth')}}">
                                                              <div class="input-group-append" data-target="#date_of_birth" data-toggle="date_of_birth">
                                                                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                                              </div>
                                                            </div>
                                                            @if ($errors->has('date_of_birth'))
                                                                <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                                                            @endif
                                                        </div>         
                                                        <div class="form-group col-sm-12">
                                                            <label class="form-label">Mobile No</label><span class="text-danger">*</span>
                                                            <input type="tel" class="form-control" name="mobile_no" id="mobile_no" value="{{$user->mobile_no ?? old('mobile_no')}}">
                                                            <input type="hidden" name="country_code" id="country_code" value="">
                                                            @if ($errors->has('mobile_no'))
                                                                <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                                                            @endif
                                                        </div>    
                                                        <div class="form-group col-sm-12">
                                                            <label class="form-label">Gender</label><span class="text-danger">*</span>
                                                            <div class="icheck-primary d-inline mr-2 ml-2">
                                                                <input type="radio" id="male" name="gender" value="1" {{ old('gender',$user->gender) == '1' ? "checked" : "" }}>
                                                                <label for="male">
                                                                    Male
                                                                </label>
                                                            </div>
                                                            <div class="icheck-primary d-inline mr-2 ml-2">
                                                                <input type="radio" id="female" name="gender" value="2"{{ old('gender',$user->gender) == '2' ? "checked" : "" }}>
                                                                <label for="female">
                                                                    Female
                                                                </label>
                                                            </div>
                                                            <div class="icheck-primary d-inline mr-2 ml-2">
                                                                <input type="radio" id="others" name="gender" value="3"{{ old('gender',$user->gender) == '3' ? "checked" : "" }}>
                                                                <label for="others">
                                                                    Others
                                                                </label>
                                                            </div>
                                                            @if ($errors->has('gender'))
                                                                <span class="text-danger">{{ $errors->first('gender') }}</span>
                                                            @endif
                                                        </div>   
                                                        <div class="form-group col-sm-12">
                                                            <label class="form-label">Industry</label><span class="text-danger">*</span>
                                                            <select class="form-control" name="industry">
                                                                <option value="" selected>Select Industry</option>
                                                              @if(!empty($industry))
                                                                @foreach($industry as $ind)
                                                                  <option value="{{ $ind->id }}" {{ old('industry',$user->industry) == $ind->id ? "selected" : "" }}>{{ $ind->name }}
                                                                  </option>
                                                                @endforeach
                                                              @endif
                                                            </select>
                                                            @if ($errors->has('industry'))
                                                                <span class="text-danger">{{ $errors->first('industry') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label class="form-label">Work Experience</label>
                                                            <select class="form-control" name="work_experience">
                                                              <option value="0">Select Work Experience</option>
                                                              <option value="1" {{ old('work_experience',$user->work_experience) == '1' ? "selected" : "" }}>Career starter</option>
                                                              <option value="2" {{ old('work_experience',$user->work_experience) == '2' ? "selected" : "" }}>Mid Experienced</option>
                                                              <option value="3" {{ old('work_experience',$user->work_experience) == '3' ? "selected" : "" }}>Experienced</option>
                                                        </select>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label class="form-label">Education Level</label>
                                                            <select class="form-control" name="education_level">
                                                              <option value="0">Select Education Level</option>
                                                              <option value="1" {{ old('education_level',$user->education_level) == '1' ? "selected" : "" }}>Under Graduate</option>
                                                              <option value="2" {{ old('education_level',$user->education_level) == '2' ? "selected" : "" }}>Graduate</option>
                                                              <option value="3" {{ old('education_level',$user->education_level) == '3' ? "selected" : "" }}>Post Graduate</option>
                                                              <option value="4" {{ old('education_level',$user->education_level) == '4' ? "selected" : "" }}>Doctorate</option>
                                                        </select>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label class="form-label">Address</label><span class="text-danger">*</span>
                                                            <textarea rows="5" cols="2" name="address" id="address" class="form-control">{{$user->address ?? old('address')}}</textarea>
                                                            @if ($errors->has('address'))
                                                                <span class="text-danger">{{ $errors->first('address') }}</span>
                                                            @endif
                                                        </div>      
                                                        <div class="col-sm-12 text-center">
                                                            <button type="submit" class="btn btn-purple" form="user-form">Save</button>
                                                            <a href="{{route('manage-users.index')}}" class="btn btn-default">Cancel</a>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <form action="{{ route('admin.change-user-password',['manage_user'=> $user->id]) }}" method="POST" id="user-change-password-form">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h6>Change Password</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="form-group col-sm-12">
                                                                <label class="form-label">Password</label><span class="text-danger">*</span>
                                                                <input type="password" name="new_password" class="form-control" value="{{ old('new_password') }}">
                                                                @if ($errors->has('new_password'))
                                                                    <span class="text-danger">{{ $errors->first('new_password') }}</span>
                                                                @endif
                                                            </div>
                                                             <div class="form-group col-sm-12">
                                                                <label class="form-label">Confirm Password</label><span class="text-danger">*</span>
                                                                <input type="password" name="confirm_password" class="form-control" value="{{ old('confirm_password') }}">
                                                                @if ($errors->has('confirm_password'))
                                                                    <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="col-sm-12 text-center">
                                                                <button type="submit" class="btn btn-purple" form="user-change-password-form">Save</button>
                                                                <a href="{{route('manage-users.index')}}" class="btn btn-default">Cancel</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>                                    
                                </div>
                                <div class="col-sm-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6>Personal Info</h6>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li><a href="#tab_1" data-toggle="tab" aria-expanded="false" class="active">Current Subcription</a></li>
              <li><a href="#tab_2" data-toggle="tab" aria-expanded="false">Course/Live Session</a></li>
              <li><a href="#tab_3" data-toggle="tab" aria-expanded="true">Subscription History</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                @if(!empty($user_plans_active))
                <div>
                    <span><b>Plan Details</b></span><br>
                    <span><b>Plan Name :</b></span><span> {{ $user_plans_active->pricing['plan_name'] }}</span><br>
                    <span><b>Paid Date :</b></span><span> {{ date('d F Y',strtotime($user_plans_active->created_at)) }}</span><br>
                    <span><b>Expiry Date :</b></span><span> {{ date('d F Y',strtotime($user_plans_active->pricing_expiry_date)) }}</span><br>
                    <span><b>Plan ID :</b></span><span> {{ $user_plans_active->pricing_id }}</span><br>
                    <span><b>Transaction ID :</b></span><span> {{ $user_plans_active->transaction_id }}</span><br>
                    <span><b>Plan Amount :</b></span><span> <i class="fas fa-rupee-sign"></i> {{ $user_plans_active->pricing_amount }}</span><br>
                    <span><b>Status :</b></span><span> 
                        @if($user_plans_active->payment_status == 1)
                            {{ "Paid" }}
                        @elseif($user_plans_active->payment_status == 0)
                            {{ "Unpaid" }}
                        @elseif($user_plans_active->payment_status == 2)
                            {{ "Cancelled" }}
                        @endif
                    </span><br>
                    <span><b>Payment Method :</b></span><span> Razor Pay</span><br>
                    <span><b>Note :</b></span><span> {{ $user_plans_active->notes }}</span><br>
                    <span><b>Plan Includes</b></span><span> 
                        @php
                            $plan_includes = json_decode($user_plans_active->pricing['plan_include'],true)['plan_include'];
                        @endphp
                        @foreach(json_decode($plan_includes) as $include)
                            <br>{{ str_replace(array('_','-'), ' ', $include) }}
                        @endforeach
                    </span><br>
                </div>
                @endif
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                No any Course/Live sessions are found.
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                @if(!empty($get_plan_history))
                    @foreach($get_plan_history as $plan_history)
                            <span><b>Plan Name :</b></span><span> {{ $plan_history->pricing['plan_name'] }}</span><br>
                            <span><b>Paid Date :</b></span><span> {{ date('d F Y',strtotime($plan_history->created_at)) }}</span><br>
                            <span><b>Expiry Date :</b></span><span> {{ date('d F Y',strtotime($plan_history->pricing_expiry_date)) }}</span><br>
                            <span><b>Plan ID :</b></span><span> {{ $plan_history->pricing_id }}</span><br>
                            <span><b>Transaction ID :</b></span><span> {{ $plan_history->transaction_id }}</span><br>
                            <span><b>Plan Amount :</b></span><span> <i class="fas fa-rupee-sign"></i> {{ $plan_history->pricing_amount }}</span><br>
                            <span><b>Payment Status :</b></span><span> 
                                @if($plan_history->deleted_at != null)
                                    {{ "Active" }}
                                @else
                                    {{ "Inactive" }}
                                @endif
                            </span><br>
                            <span><b>Status :</b></span><span> 
                                @if($plan_history->payment_status == 1)
                                    {{ "Paid" }}
                                @elseif($plan_history->payment_status == 0)
                                    {{ "Unpaid" }}
                                @elseif($plan_history->payment_status == 2)
                                    {{ "Cancelled" }}
                                @endif
                            </span><br>
                            <span><b>Payment Method :</b></span><span> Razor Pay</span><br>
                            <span><b>Note :</b></span><span> {{ $plan_history->notes }}</span><br>
                        <hr>
                    @endforeach
                @endif
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
            </div>
        </div>
            <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>
                        {{--</form>--}}
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
<script type="text/javascript" src="{{ asset('backend/plugins/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/frontend/js/intlTelInput.js') }}"></script>
<script src="{{ asset('/backend/developer/users/users-edit.js') }}"></script>
    {{--<script src="{{ asset('assets/backend/developer/users/users-create.js') }}"></script>--}}
@endsection

@section('script')
@endsection

