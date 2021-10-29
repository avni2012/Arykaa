@extends('layouts.backend.master')

@section('title', 'Manage Permission')

@section('breadcrumb-title', 'Manage Permission')

@section('breadcrumb-item') 
<li class="breadcrumb-item active">Manage Permission</li>
@endsection

@section('css') 

@endsection

@section('style') 
@endsection


@section('content')
  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Manage Roles > Manage Permissions</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('manage-role.index')}}">Manage Roles</a></li>
                <li class="breadcrumb-item active">Manage Permission</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="manage_role_page">
            <div class="row drpdn_btn_add_btn">
              <div class="col-sm-12">
                <div class="flash-message">
                  @if(session()->has('message.level'))
                    <div class="alert alert-{{ session('message.level') }}">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      {{ session('message.content') }}
                    </div>
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                  <div class="manage_permission_page">
                    <form action="{{route('permisstion-store',$role->id)}}" method="post" id="form">
                      <div class="">@csrf
                          <label class="role_type">Type : <span> {{ $role->display_name }} </span></label>
                          <hr>
                          @if(count($allpermissions) > 0)
                            @foreach($allpermissions as $permission)
                            <div class="manage_permission_blocks">
                                <div class="manage_customeer">
                                    <p class="main_block_title">{{$permission->display_name}}</p>
                                    <hr>
                                    <div class="block_title flex_evenly_center">
                                        <div class="left_block">Name</div>
                                        <div class="right_block">Access</div>
                                    </div>
                                    @if(count($permission->PermissionData) > 0)  
                                      @foreach($permission->PermissionData  as $permission_data)
                                      <div class="block_content flex_evenly_center">
                                          <div class="left_block">{{$permission_data->display_name}}
                                          </div>
                                          <div class="right_block">
                                              <label class="fancy-radio">
                                                  <input name="permisstion_[{{$permission_data->id}}]"
                                                  {{ ($permission_data->IsActive != null) ?'checked':''}}
                                                   value="yes" type="radio">
                                                  <span><i></i>Yes</span>
                                              </label>
                                              <label class="fancy-radio">
                                                  <input name="permisstion_[{{$permission_data->id}}]" 
                                                   {{ ($permission_data->IsActive == null)? 'checked' :''}}
                                                  value="no" type="radio">
                                                  <span><i></i>No</span>
                                              </label>
                                          </div>
                                      </div>
                                      @endforeach
                                    @else
                                      <div class="manage_permission_blocks">
                                          <div class="manage_customeer">
                                              <p class="main_block_title">No Data Yet!!</p>
                                          </div>                               
                                      </div>
                                    @endif
                                </div>                               
                            </div>
                            @endforeach
                          @else
                            <div class="manage_permission_blocks">
                                <div class="manage_customeer">
                                    <p class="main_block_title">No Data Yet!!</p>
                                </div>                               
                            </div>
                          @endif
                      </div>
                      <div class="panel-footer">
                        <div class="bottom text-center">
                          <input type="submit" class="btn btn-purple" value="Save">
                          <a href="{{route('manage-role.index')}}" class="btn btn-default">Cancel</a>
                        </div>
                      </div>
                    </form>
                  </div>
              </div>
              <!-- /.col -->
            </div>
            <form action="{{route('permisstion-additional-store',$role->id)}}" method="post" id="additional_form">
              @csrf
                      <div class="">
                          @if(!empty($additional_roles))
                          <label class="role_type">Type : <span>Additional Roles </span></label>
                          <hr>
                          @foreach($additional_roles as $key => $role)
                            <div class="manage_permission_blocks">
                                <div class="manage_customeer">
                                      <div class="block_content flex_evenly_center">
                                          <div class="left_block">{{ $key }}
                                          </div>
                                          <div class="right_block">
                                              <label class="fancy-radio">
                                                  <input name="{{ $key }}" value="1" type="radio" {{ ($role == '1') ? "checked" : "" }}>
                                                  <span><i></i>Yes</span>
                                              </label>
                                              <label class="fancy-radio">
                                                  <input name="{{ $key }}" value="0" type="radio" {{ ($role == '0') ? "checked" : "" }}>
                                                  <span><i></i>No</span>
                                              </label>
                                          </div>
                                      </div>
                                </div>                               
                            </div>
                          @endforeach
                          @else
                            <div class="manage_permission_blocks">
                                <div class="manage_customeer">
                                    <p class="main_block_title">No Data Yet!!</p>
                                </div>                               
                            </div>
                          @endif
                      </div>
                      <div class="panel-footer">
                        <div class="bottom text-center">
                          <input type="submit" class="btn btn-purple" value="Save">
                          <a href="{{route('manage-role.index')}}" class="btn btn-default">Cancel</a>
                        </div>
                      </div>
                    </form>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
 
@endsection

@section('script-js-last')
@endsection

@section('script')
<!-- page script -->

@endsection