@extends('layouts.backend.master')

@section('title', 'Manage Role')

@section('breadcrumb-title', 'Manage Role')

@section('breadcrumb-item')
<li class="breadcrumb-item active">Manage Role</li>
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
              <h1>Manage Role</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}#">Home</a></li>
                <li class="breadcrumb-item active">Manage Role</li>
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
              <div class="col-sm-6">
                <div class="dropdown_select form-group">
                  <!-- <select class="form-control">
                    <option>Delete</option>
                  </select>
                  <button type="button" class="btn btn-default btn-purple">Apply</button> -->
                </div>
              </div>
              <div class="col-sm-6">
                @if(Auth::user()->can('create-role'))
                <div class="add_staff_btn mb-3">
                  <button type="button" class="btn btn-default btn-purple" data-toggle="modal" data-target="#addroledetail" id="addrole">
                    <i class="fas fa-plus-circle"></i> Add New Roles
                  </button>
                </div>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                 <div class="flash-message">
                  @if(session()->has('message.level'))
                    <div class="alert alert-{{ session('message.level') }}">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      {{ session('message.content') }}
                      <?php Session::forget('message')?>
                    </div>
                  @endif
                </div>
                <div class="card">
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="table-responsive">
                        <table id="roleDatatable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>
                                    #No
                                </th>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Description</th>
                                <th>Role's Permission</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
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
    <!-- /.content-wrapper -->

    <!-- Modal -->
    <div class="modal fade edit_role_detail_popup" id="addroledetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content role">
              <form id="addrollform" method="post" action="{{route('manage-role.store')}}">
                <div class="modal-header">@csrf
                    <h5 class="modal-title" id="exampleModalLabel">Add New Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                      <div class="  alert alert-danger " style="display:none"></div>
                      <div class="  alert alert-success " style="display:none"></div>

                    <div class="">
                        <div class="form-group">
                            <label class="form-label">Role Name</label><span class="text-danger">*</span>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Role Displayed Name</label><span class="text-danger">*</span>
                            <input type="text" name="display_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Role Description</label><span class="text-danger">*</span>
                            <input type="text" name="description" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-purple">Save Roles</button>
                    <button type="button" class="btn btn-purple" data-dismiss="modal">Cancel</button>

                </div>
              </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade update_role_detail_popup" id="updateroledetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content role">
              <form id="editrollform" method="post" action="{{route('manage-role.store')}}">
                <div class="modal-header">@csrf
                     <h5 class="modal-title" id="exampleModalLabel">Update Role Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <input type="hidden" id="id" name="id" >
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="alert alert-success" style="display:none"></div>
                    <div class="">
                        <div class="form-group">
                            <label class="form-label">Role Name</label><span class="text-danger">*</span>
                            <input type="text" name="name" id="edit_name_role" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Role Displayed Name</label><span class="text-danger">*</span>
                            <input type="text" name="display_name" id="edit_display_name_role" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Role Description</label><span class="text-danger">*</span>
                            <input type="text" name="description" id="edit_discription_role" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-purple">Update Roles</button>
                    <button type="button" class="btn btn-purple" data-dismiss="modal">Cancel</button>

                </div>
              </form>
            </div>
        </div>
    </div>

@endsection

@section('script-js-last')
  <script src="{{asset('backend/developer/developer.js')}}"></script>
@endsection

@section('script')
<script>
    var csrftoken = '{{ csrf_token() }}';
    var base_url = "{{url('/')}}";
    var delete_edit_action = false;
    var deletecheck = false;
</script>

@if(Auth::guard()->user()->can('delete-role') || Auth::guard()->user()->can('edit-role'))
<script>
  delete_edit_action = true;
</script>
@endif
@endsection
