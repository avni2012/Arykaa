@extends('layouts.backend.master')

@section('title', 'Manage Product')

@section('breadcrumb-title', 'Manage Product')

@section('breadcrumb-item')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<li class="breadcrumb-item active">Manage Product</li>
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
    <script type="text/javascript">
      $(document).ready(function(){ 
        var role_id = '{!! json_encode($role_id); !!}';
        /*$('#productSubDatatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + '/control-panel/get-product-data' //window.location.href
        });*/
        if(role_id == 1){
          var productSubDatatable = $('#productSubDatatable').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, "desc" ]],
            ajax: window.location.href,
            columns: [
              {data: 'check', name:'check', orderable: false, searchable: false, visible: deletecheck},
              {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'rel_id', name: 'rel_id'},
              {data: 'product_name', name: 'product_name'},
              {data: 'chahat_catlog_no', name: 'chahat_catlog_no'},
              {data: 'chahat_design_no', name: 'chahat_design_no'},
              {data: 'purchase_price', name: 'purchase_price'},
              {data: 'our_price', name: 'our_price'},
              {data: 'product_type', name: 'product_type'},
              {data: 'fabric', name: 'fabric'},
              {data: 'ucode', name: 'ucode'},
              {data: 'ncode', name: 'ncode'},
              {data: 'color', name: 'color'},
              {data: 'total_stock', name: 'total_stock'},
              {data: 'available_stock', name: 'available_stock'},
              {data: 'date', name: 'date'},
              {data: 'image1', name: 'image1'},
              {data: 'image2', name: 'image2'},
              {data: 'action', name: 'action', orderable: false, searchable: false, visible: delete_edit_action}
            ]
          });
        }else if(role_id == 2){
          var productSubDatatable = $('#productSubDatatable').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, "desc" ]],
            ajax: window.location.href,
            columns: [
              // {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'rel_id', name: 'rel_id'},
              {data: 'product_type', name: 'product_type'},
              {data: 'fabric', name: 'fabric'},
              {data: 'color', name: 'color'},
              {data: 'available_stock', name: 'available_stock'},
              {data: 'image1', name: 'image1'},
              {data: 'image2', name: 'image2'},
              {data: 'date', name: 'date'},
            ]
          });
        }else if(role_id == 3){
          var productSubDatatable = $('#productSubDatatable').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, "desc" ]],
            ajax: window.location.href,
            columns: [
              // {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'rel_id', name: 'rel_id'},
              {data: 'chahat_catlog_no', name: 'chahat_catlog_no'},
              {data: 'chahat_design_no', name: 'chahat_design_no'},
              {data: 'our_price', name: 'our_price'},
              {data: 'product_type', name: 'product_type'},
              {data: 'fabric', name: 'fabric'},
              {data: 'color', name: 'color'},
              {data: 'available_stock', name: 'available_stock'},
              {data: 'image1', name: 'image1'},
            ]
          });
        }else if(role_id == 4){
          var productSubDatatable = $('#productSubDatatable').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, "desc" ]],
            ajax: window.location.href,
            columns: [
              // {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'rel_id', name: 'rel_id'},
              {data: 'product_type', name: 'product_type'},
              {data: 'fabric', name: 'fabric'},
              {data: 'color', name: 'color'},
              {data: 'available_stock', name: 'available_stock'},
              {data: 'image2', name: 'image2'},
            ]
          });
        }else if(role_id == 5){
          var productSubDatatable = $('#productSubDatatable').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, "desc" ]],
            ajax: window.location.href,
            columns: [
              // {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'rel_id', name: 'rel_id'},
              {data: 'product_type', name: 'product_type'},
              {data: 'fabric', name: 'fabric'},
              {data: 'color', name: 'color'},
              {data: 'available_stock', name: 'available_stock'},
              {data: 'image2', name: 'image2'},
            ]
          });
        }else if(role_id == 6){
          var productSubDatatable = $('#productSubDatatable').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, "desc" ]],
            ajax: window.location.href,
            columns: [
              // {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'rel_id', name: 'rel_id'},
              {data: 'product_type', name: 'product_type'},
              {data: 'fabric', name: 'fabric'},
              {data: 'color', name: 'color'},
              {data: 'available_stock', name: 'available_stock'},
              {data: 'image2', name: 'image2'},
            ]
          });
        }else if(role_id == 7){
          var productSubDatatable = $('#productSubDatatable').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, "desc" ]],
            ajax: window.location.href,
            columns: [
              
            ]
          });
        }
    });
    </script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Manage Product</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Manage Product</li>
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
                @if(Auth::guard()->user()->can('delete-product'))
                {{--<div class="dropdown_select form-group">
                  <select class="form-control">
                    <option>Delete</option>
                  </select>
                  <button type="button" onclick="MultipleDelete('/multiple-product-delete','productDatatable')" class="btn btn-default btn-purple">Apply</button>
                </div>--}}
                @endif
              </div>
              <div class="col-sm-6">
                  <div class="add_staff_btn">
                    @if(Auth::user()->can('create-product'))
                      <a type="button" class="btn btn-default btn-purple" href="{{route('manage-product.create')}}">
                        <i class="fas fa-plus-circle"></i> Add product
                      </a>
                    @endif
                    @if(Auth::guard()->user()->can('delete-product'))<button type="button" onclick="MultipleDelete('/multiple-product-delete','productDatatable')" class="btn btn-default btn-purple"> <i class="fas fa-trash-alt"></i>  Delete Selected</button>@endif
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
                      <table id="productSubDatatable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          @if(auth()->guard()->user()->roles->first()->name == 'super_admin')
                          <th class="select_all">
                            <label class="container_chk ">
                              <input type="checkbox" >
                              <span class="checkmark"></span>
                            </label>
                          </th>
                          <th>No</th>
                          @endif
                          @if($column_name_arr != null)
                            @foreach($column_name_arr as $column)
                              <th>{{ $column }}</th>
                            @endforeach
                          @else
                            <th>Rel Id</th>
                            <th>Product Name</th>
                            <th>Chahat Catlog No</th>
                            <th>Chahat Design No</th>
                            <th>Purchase Price</th>
                            <th>Our Price</th>
                            <th>Type</th>
                            <th>Fabric</th>
                            <th>Ucode</th>
                            <th>Ncode</th>
                            <th>Color</th>
                            <th>Total Stock</th>
                            <th>Available Stock</th>
                            <th>Date</th>
                            <th>Image1</th>
                            <th>Image2</th>
                          @endif
                          @if(auth()->guard()->user()->roles->first()->name == 'super_admin')
                            @if(Auth::guard()->user()->can('delete-product') || Auth::guard()->user()->can('edit-product'))
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
    var product = '{!! json_encode($product) !!}';
    var vendor = '{!! json_encode($role_id) !!}';
</script>
@if(Auth::guard()->user()->can('delete-product') || Auth::guard()->user()->can('edit-product'))
<script>
   delete_edit_action = true;
</script>
@endif
@if(Auth::guard()->user()->can('delete-product'))
<script>
   deletecheck = true;
</script>
@endif
@endsection

