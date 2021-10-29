@extends('layouts.backend.master')

@section('title', 'Manage Order')

@section('breadcrumb-title', 'Manage Order')

@section('breadcrumb-item')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<li class="breadcrumb-item active">Manage Order</li>
@endsection

@section('css')
@endsection

@section('style')
<style type="text/css">
  .trash_icon{
    cursor: pointer;
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
              <h1>Manage Order</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Manage Order</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="manage_staff_page">
            <div class="row drpdn_btn_add_btn">
              <div class="col-sm-6">
                @if(Auth::guard()->user()->can('delete-order'))
                {{--<div class="dropdown_select form-group">
                  <select class="form-control">
                    <option>Delete</option>
                  </select>
                  <button type="button" onclick="MultipleDelete('/multiple-order-delete','orderDatatable')" class="btn btn-default btn-purple">Apply</button>
                </div>--}}
                @endif
              </div>
              <div class="col-sm-6">
                  <div class="add_staff_btn">
                    @if(Auth::user()->can('create-order'))
                      <a type="button" class="btn btn-default btn-purple" href="{{route('manage-order.create')}}">
                        <i class="fas fa-plus-circle"></i> Add Order
                      </a>
                    @endif
                    @if(Auth::guard()->user()->can('delete-order'))<button type="button" onclick="MultipleDelete('/multiple-order-delete','orderDatatable')" class="btn btn-default btn-purple"> <i class="fas fa-trash-alt"></i>  Delete Selected</button>@endif
                </div>
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
                      <table id="orderDatatable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          @if(auth()->guard()->user()->roles->first()->name == 'super_admin')
                          <th class="select_all">
                            <label class="container_chk ">
                              <input type="checkbox" >
                              <span class="checkmark"></span>
                            </label>
                          </th>
                          @endif
                          <th>No</th>
                          {{--<th>Order Id</th>--}}
                          <th>Total Price</th>
                          <th>Order Date</th>
                          <th>Status</th>
                          @if(auth()->guard()->user()->roles->first()->name == 'super_admin')
                            @if(Auth::guard()->user()->can('delete-order') || Auth::guard()->user()->can('edit-order'))
                              <th>Action</th>
                            @endif
                          @endif
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

  </div>
@endsection


@section('script-js-last')
<script src="{{asset('backend/developer/developer.js')}}"></script>
@endsection

@section('script')
<script>
    var csrftoken = '{{ csrf_token() }}';
    var base_url = "{{url('/')}}";
    var role_id = '{!! json_encode($role_id); !!}';
    $(document).ready(function(){
      if(role_id == 1){
        var orderDatatable = $('#orderDatatable').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, "desc" ]],
            ajax  : window.location.href,
            columns: [
              {data: 'check', name:'check', orderable: false, searchable: false, visible: deletecheck},
              {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              // {data: 'order_id', name: 'order_id'},
              {data: 'total_price', name: 'total_price'},
              {data: 'order_date', name: 'order_date'},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action', orderable: false, searchable: false, visible: delete_edit_action}
            ]
        });
    }else{
        var orderDatatable = $('#orderDatatable').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, "desc" ]],
            ajax  : window.location.href,
            columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              // {data: 'order_id', name: 'order_id'},
              {data: 'total_price', name: 'total_price'},
              {data: 'order_date', name: 'order_date'},
              {data: 'status', name: 'status'},
            ]
        });
    }
    });
</script>
@if(Auth::guard()->user()->can('delete-order') || Auth::guard()->user()->can('edit-order'))
<script>
   delete_edit_action = true;
</script>
@endif
@if(Auth::guard()->user()->can('delete-order'))
<script>
   deletecheck = true;
</script>
@endif
@endsection

