@extends('layouts.backend.master')

@section('title', 'Create Order')

@section('breadcrumb-title', 'Create Order')

@section('breadcrumb-item')
<li class="breadcrumb-item active">Create Order</li>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('/backend/plugins/datepicker/bootstrap-datepicker.min.css') }}">
@endsection

@section('style')
<style type="text/css">
  .input-capital{
    text-transform: uppercase;
  }
  .vendor-style{
    padding: 1px 5px;
  }
  #product-list{
    float: left;
    list-style: none;
    margin-top: -3px;
    padding: 0;
    width: 282px;
    position: absolute;
    z-index: 1;
  }
  #product-list li {
    padding: 10px;
    background: #f0f0f0;
    border-bottom: #bbb9b9 1px solid;
  }
  #product-list li:hover {
    background: #ece3d2;
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
              <h1>Create Order</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item "><a href="{{route('manage-order.index')}}">Manage Order</a></li>
                <li class="breadcrumb-item active">Create Order</li>
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
          <div class="manage_Cms_page ">
            <form name="Order-create" id="Order-create" action="{{route('manage-order.store')}}" method="Post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                          <div class="row col-sm-12">
                            <div class="col-sm-3">
                              <label class="form-label">Product Name</label><span class="text-danger">*</span>
                              <input type="text" id="product_name" name="product_name[0]" class="form-control" value="{{old('product_name')}}" onkeyup="ProductName(this,0)">
                              <div id="suggesstion-box"><ul id="product-list"></ul></div>
                              @if ($errors->has('product_name'))
                                <span class="text-danger">{{ $errors->first('product_name') }}</span>
                              @endif
                            </div>
                            <div class="col-sm-2">
                              <label class="form-label">Product SKU</label><span class="text-danger">*</span>
                              <input type="text" id="product_sku" name="product_sku[0]" class="form-control" value="{{old('product_sku')}}" onkeyup="ProductSKU(this,0)">
                              @if ($errors->has('product_sku'))
                                <span class="text-danger">{{ $errors->first('product_sku') }}</span>
                              @endif
                            </div>
                            <div class="col-sm-2">
                              <label class="form-label">Quantity</label><span class="text-danger">*</span>
                              <select class="form-control" name="quantity[0]" id="quantity">
                                <option value="0">Select Quantity</option>
                                @for($i=1; $i<=10; $i++)
                                  <option class="{{ $i }}">{{ $i }}</option>
                                @endfor
                              </select>
                              @if ($errors->has('quantity'))
                                <span class="text-danger">{{ $errors->first('quantity') }}</span>
                              @endif
                            </div>
                            <div class="col-sm-2">
                              <label class="form-label">Price</label><span class="text-danger">*</span>
                              <input type="text" name="price[0]" class="form-control readonly-field" value="{{old('price')}}">
                              @if ($errors->has('price'))
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                              @endif
                            </div>
                            <div class="col-sm-2">
                              <label class="form-label">Availability</label><span class="text-danger">*</span>
                              <input type="number" min="0" name="availability[0]" class="form-control readonly-field" value="{{old('availability')}}">
                            </div>
                            <div class="col-sm-1">
                              <label class="form-label"></label>
                              <button type="button" id="addOrderForm" class="btn btn-primary mt-4"><i class="fa fa-plus-circle"></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="row col-sm-12">
                            <div class="col-sm-3">
                              <label class="form-label">Sub Total</label><span class="text-danger">*</span>
                              <input type="number" min="0" name="sub_total[0]" class="form-control readonly-field" value="{{old('sub_total')}}">
                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
              </div>
              <div id="ShowOrderForm"></div>
              <div class="row">
                <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-12 text-center">
                              <button type="submit" class="btn btn-purple" form="order-create">Create Order</button>
                              <a href="{{ route('manage-order.index') }}" class="btn btn-default">Cancel</a>
                          </div>
                        </div>
                      </div>
                    </div>
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
  </div>
@endsection

@section('script-js-last')
<script src="{{asset('backend/developer/developer.js')}}"></script>
<script type="text/javascript">
  var base_url = '{{ url("/") }}';
  var csrftoken = '{{ csrf_token() }}';
  $(".readonly-field").keypress(function (evt) {
    evt.preventDefault();
  });
</script>
@endsection

@section('script')
@endsection

