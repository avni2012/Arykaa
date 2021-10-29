@extends('layouts.backend.master')

@section('title', 'Edit Product')

@section('breadcrumb-title', 'Edit Product')

@section('breadcrumb-item')
<li class="breadcrumb-item active">Edit Product</li>
@endsection

@section('css')
<style type="text/css">
  .vendor-style{
    padding: 1px 5px;
  }
</style>
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('/backend/plugins/datepicker/bootstrap-datepicker.min.css') }}">
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
              <h1>Edit Product</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('manage-product.index')}}">Manage Product</a></li>
                <li class="breadcrumb-item active">Edit Product</li>
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
          <div class="manage_Product_page ">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <!-- /.card-header -->
                  <div class="card-body">
                    <form name="Product-Edit" id="Product-Edit" action="{{route('manage-product.update',$product->id)}}" method="Post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        {{ method_field('PATCH') }}
                        <div class="row">
                          <div class="col-sm-4">
                            <label class="form-label">Rel Id</label><span class="text-danger">*</span>
                            <input type="text" name="rel_id" class="form-control" value="{{old('rel_id',$product->rel_id)}}">
                            @if ($errors->has('rel_id'))
                              <span class="text-danger">{{ $errors->first('rel_id') }}</span>
                            @endif
                          </div>
                          <div class="col-sm-4">
                            <label class="form-label">Product Name</label><span class="text-danger">*</span>
                            <input type="text" name="product_name" class="form-control" value="{{old('product_name',$product->product_name)}}">
                            @if ($errors->has('product_name'))
                              <span class="text-danger">{{ $errors->first('product_name') }}</span>
                            @endif
                          </div>
                          <div class="col-sm-4">
                            <label class="form-label">Chahat Catlog No</label><span class="text-danger">*</span>
                            <input type="text" name="chahat_catlog_no" class="form-control" value="{{old('chahat_catlog_no',$product->chahat_catlog_no)}}">
                            @if ($errors->has('chahat_catlog_no'))
                              <span class="text-danger">{{ $errors->first('chahat_catlog_no') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="form-group ">
                        <div class="row">
                          <div class="col-sm-4">
                            <label class="form-label">Chahat Design No</label><span class="text-danger">*</span>
                            <input type="text" name="chahat_design_no" class="form-control" value="{{old('chahat_design_no',$product->chahat_design_no)}}">
                            @if ($errors->has('chahat_design_no'))
                              <span class="text-danger">{{ $errors->first('chahat_design_no') }}</span>
                            @endif
                          </div>
                          <div class="col-sm-4">
                            <label class="form-label">Purchase Price</label><span class="text-danger">*</span>
                            <input type="number" min="0" name="purchase_price" class="form-control" value="{{old('purchase_price',$product->purchase_price)}}">
                            @if ($errors->has('purchase_price'))
                              <span class="text-danger">{{ $errors->first('purchase_price') }}</span>
                            @endif
                          </div>
                          <div class="col-sm-4">
                            <label class="form-label">Our Price</label><span class="text-danger">*</span>
                            <input type="number" min="0" name="our_price" class="form-control" value="{{old('our_price',$product->our_price)}}">
                            @if ($errors->has('our_price'))
                              <span class="text-danger">{{ $errors->first('our_price') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-4">
                            <label class="form-label">Product Type</label><span class="text-danger">*</span>
                            <input type="text" name="product_type" class="form-control" value="{{old('product_type',$product->product_type)}}">
                            @if ($errors->has('product_type'))
                              <span class="text-danger">{{ $errors->first('product_type') }}</span>
                            @endif
                          </div>
                          <div class="col-sm-4">
                            <label class="form-label">Fabric</label><span class="text-danger">*</span>
                            <input type="text" name="fabric" class="form-control" value="{{old('fabric',$product->fabric)}}">
                            @if ($errors->has('fabric'))
                              <span class="text-danger">{{ $errors->first('fabric') }}</span>
                            @endif
                          </div>
                          <div class="col-sm-4">
                            <label class="form-label">Ucode</label><span class="text-danger">*</span>
                            <input type="text" name="ucode" class="form-control" value="{{old('ucode',$product->ucode)}}">
                            @if ($errors->has('ucode'))
                              <span class="text-danger">{{ $errors->first('ucode') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-4">
                            <label class="form-label">Ncode</label><span class="text-danger">*</span>
                            <input type="text" name="ncode" class="form-control" value="{{old('ncode',$product->ncode)}}">
                            @if ($errors->has('ncode'))
                              <span class="text-danger">{{ $errors->first('ncode') }}</span>
                            @endif
                          </div>
                          <div class="col-sm-4">
                            <label class="form-label">Color</label><span class="text-danger">*</span>
                            <input type="text" name="color" class="form-control" value="{{old('color',$product->color)}}">
                            @if ($errors->has('color'))
                              <span class="text-danger">{{ $errors->first('color') }}</span>
                            @endif
                          </div>
                          <div class="col-sm-4">
                            <label class="form-label">Total Stock</label><span class="text-danger">*</span>
                            <input type="number" name="total_stock" min="0" class="form-control" value="{{old('total_stock',$product->total_stock)}}">
                            @if ($errors->has('total_stock'))
                              <span class="text-danger">{{ $errors->first('total_stock') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-4">
                            <label class="form-label">Available Stock</label><span class="text-danger">*</span>
                            <input type="number" min="0" name="available_stock" class="form-control" value="{{old('available_stock',$product->available_stock)}}">
                            @if ($errors->has('available_stock'))
                              <span class="text-danger">{{ $errors->first('available_stock') }}</span>
                            @endif
                          </div>
                          <div class="col-sm-4">
                            <label class="form-label">Date</label><span class="text-danger">*</span>
                            <div class="input-group date" data-provide="date">
                              <input type="text" class="form-control date" name="date" id="date" value="{{old('date',$product->date)}}">
                              <div class="input-group-addon">
                                  <span class="glyphicon glyphicon-th"></span>
                              </div>
                            </div>
                            @if ($errors->has('date'))
                              <span class="text-danger">{{ $errors->first('date') }}</span>
                            @endif
                          </div>
                          <div class="col-sm-4">
                            <label class="form-label">Time to ship</label><span class="text-danger">*</span>
                            <input type="number" min="1" name="time_to_ship" class="form-control" value="{{old('time_to_ship',$product->time_to_ship)}}">
                            @if ($errors->has('time_to_ship'))
                              <span class="text-danger">{{ $errors->first('time_to_ship') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-4">
                            <label class="form-label">Image1</label>
                            <input type="file" name="image1" id="image1" class="form-control" onchange="readURLOne(this);" accept="jpg,jpeg,png">
                            @if ($errors->has('image1'))
                              <span class="text-danger">{{ $errors->first('image1') }}</span>
                            @endif
                          </div>
                          <div class="col-md-1" style="float: right; margin-right: 130px">
                            <img id="image_one" src="@if($product->image1) {{ asset('/backend/images/'.$product->image1) }} @else {{asset('backend/img/img.png')}} @endif" height="100px" width="100px"/>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-4">
                            <label class="form-label">Image2</label>
                            <input type="file" name="image2" id="image2" class="form-control" onchange="readURLSecond(this);" accept="jpg,jpeg,png">
                            @if($errors->has('image2'))
                              <span class="text-danger">{{ $errors->first('image2') }}</span>
                            @endif
                          </div>
                          <div class="col-md-1" style="float: right; margin-right: 130px">
                            <img id="image_second" src="@if($product->image2) {{ asset('/backend/images/'.$product->image2) }} @else {{asset('backend/img/img.png')}} @endif" height="100px" width="100px"/>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="form-group">
                        @if(!empty($vendors))
                          @foreach($vendors as $key => $vendor)
                          <div class="row align-items-center">
                            <div class="col-sm-2">
                              <label class="btn-secondary vendor-style mb-0">{{ $vendor->name }}</label>
                              <input type="hidden" name="vendor_id[]" id="" value="{{ $vendor->id }}">
                            </div>
                            @if(count($vendor->product_vendor_details) > 0)
                              <div class="col-sm-3">
                                <input type="number" min="0" name="price[]" id="price" class="form-control" placeholder="Price" value="{{ $vendor->product_vendor_details->first()->price }}">
                              </div>
                              <div class="col-sm-3">
                                <input type="text" name="SKU[]" id="SKU" class="form-control" placeholder="SKU" value="{{ $vendor->product_vendor_details->first()->SKU }}">
                              </div>
                              <div class="col-sm-2">
                                <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input is-show-hide" id="is_show_hide{{ $key }}" value="" @if($vendor->product_vendor_details->first()->is_show == '1') {{ "checked" }} @endif>
                                  <label class="custom-control-label" for="is_show_hide{{ $key }}"></label>
                                  <input type="hidden" name="is_show[]" id="is_show{{ $key }}" value="">
                                </div>
                              </div>
                            @else
                              <div class="col-sm-3">
                                <input type="number" min="0" name="price[]" id="price" class="form-control" placeholder="Price" value="">
                              </div>
                              <div class="col-sm-3">
                                <input type="text" name="SKU[]" id="SKU" class="form-control" placeholder="SKU" value="">
                              </div>
                              <div class="col-sm-2">
                                <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input is-show-hide" id="is_show_hide{{ $key }}" value="">
                                  <label class="custom-control-label" for="is_show_hide{{ $key }}"></label>
                                  <input type="hidden" name="is_show[]" id="is_show{{ $key }}" value="">
                                </div>
                              </div>
                            @endif
                          </div>
                          @endforeach
                        @endif
                      </div>
                      <div class="form-group">
                        <div class="text-right">
                            <button type="submit" form="Product-Edit" class="btn btn-purple">Save Product</button>
                            <a href="{{route('manage-product.index')}}" class="btn btn-default">Cancel</a>
                        </div>
                      </div>
                  </form>
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
<script src="{{ asset('/backend/plugins/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{asset('backend/developer/developer.js')}}"></script>
@endsection

@section('script')
@endsection

