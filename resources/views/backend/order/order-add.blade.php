<div class="row order-frm" id="order_form{{ $index }}">
                <div class="col-12">
                  <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                          <div class="row col-sm-12">
                            <div class="col-sm-3">
                              <label class="form-label">Product Name</label><span class="text-danger">*</span>
                              <input type="text" name="product_name[{{ $index }}]" id="product_name{{ $index }}" class="form-control" value="{{old('product_name')}}" onkeyup="ProductName(this,'{{ $index }}')">
                              @if ($errors->has('product_name'))
                                <span class="text-danger">{{ $errors->first('product_name') }}</span>
                              @endif
                            </div>
                            <div class="col-sm-2">
                              <label class="form-label">Product SKU</label><span class="text-danger">*</span>
                              <input type="text" name="product_sku[{{ $index }}]" id="product_sku{{ $index }}" class="form-control" value="{{old('product_sku')}}" onkeyup="ProductSKU(this,'{{ $index }}')">
                              @if ($errors->has('product_sku'))
                                <span class="text-danger">{{ $errors->first('product_sku') }}</span>
                              @endif
                            </div>
                            <div class="col-sm-2">
                              <label class="form-label">Quantity</label><span class="text-danger">*</span>
                              <input type="text" name="quantity[{{ $index }}]" id="quantity{{ $index }}" class="form-control" value="{{old('quantity')}}">
                              @if ($errors->has('quantity'))
                                <span class="text-danger">{{ $errors->first('quantity') }}</span>
                              @endif
                            </div>
                            <div class="col-sm-2">
                              <label class="form-label">Price</label><span class="text-danger">*</span>
                              <input type="text" name="price[{{ $index }}]" id="price{{ $index }}" class="form-control" value="{{old('price')}}" readonly="">
                              @if ($errors->has('price'))
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                              @endif
                            </div>
                            <div class="col-sm-2">
                              <label class="form-label">Availability</label><span class="text-danger">*</span>
                              <input type="number" min="0" id="availability{{ $index }}" name="availability[{{ $index }}]" class="form-control" value="{{old('availability')}}">
                            </div>
                            <div class="col-sm-1">
                              <label class="form-label"></label>
                              <button type="button" id="deleteOrderForm{{ $index }}" class="btn btn-danger mt-4 delete-order-form"><i class="fa fa-minus-square"></i></button>
                              <script type="text/javascript">
                                $("#deleteOrderForm{{ $index }}").click(function(){
                                  $("#order_form{{ $index }}").remove();
                                });
                              </script>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="row col-sm-12">
                            <div class="col-sm-3">
                              <label class="form-label">Sub Total</label><span class="text-danger">*</span>
                              <input type="number" min="0" id="sub_total{{ $index }}" name="sub_total[{{ $index }}]" class="form-control" value="{{old('sub_total')}}">
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