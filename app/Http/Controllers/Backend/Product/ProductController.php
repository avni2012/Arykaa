<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
// use Validator;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Product;
use App\AdditionalRole;
use App\Models\Vendor;
use App\Models\ProductVendorDetail;
use Auth;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{    
            if ($request->ajax()) {
                $product = Product::latest()->get();
                return Datatables::of($product)
                        ->addIndexColumn()
                        ->addColumn('check',function($row){
                            $check = '';
                            if(Auth::guard()->user()->can('delete-product'))
                            {
                                $check = '<label class="container_chk"> <input type="checkbox" value="'.$row->id.'"><span class="checkmark"></span></label>';
                            }
                            return $check;
                        })
                        ->addColumn('action', function($row){
                        $btn ='';
                        if (Auth::user()->can('edit-product') || Auth::guard()->user()->can('delete-product'))
                        {
                            $btn = "<span class=' p-1 bg-secondary text-white border-radius ' style ='border-radius: 20px;'>Access Denied! </span>";


                            if (Auth::user()->can('edit-product'))
                            {
                                 $btn = '<a href="'.url('control-panel/manage-product/'.$row->id.'/edit').'" class="edit_icon" title="Edit">
                                <i class="fas fa-edit icon_color" ></i> </a>';
                            }
                            if (Auth::user()->can('delete-product'))
                            {
                                $btn = $btn . '<a onclick=deletesingle("'. $row->id .'","control-panel/manage-product","productDatatable") title="Delete" class="trash_icon"><i class="fas fa-trash-alt icon_color" ></i> </a>';
                            }
                        }
                            return $btn;
                        })
                        ->rawColumns(['action','check'])
                        ->make(true);
            }
                return view('backend.product.index',compact('products'));
        } catch (\Exception $e) {
            return redirect()->route('manage-product.index')
                                ->with(['message.content' => $e->getMessage(),'message.level' => 'error']);    
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {   
                if(auth()->guard()->user()->can('create-product')){
                    $vendors = Vendor::get();
                    return view('backend.product.create',compact('vendors'));
                }else{
                    return abort('403','Forbidden');
                }
        } catch (Exception $e) {
            return redirect()->route('manage-product.index')
                                ->with(['message.content' => $e->getMessage(),'message.level' => 'error']);   
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
                $validator = Validator::make($request->all(), [
                    'rel_id'  => 'required|max:255|min:2',
                    'product_name' => 'required|max:255|min:2',
                    'chahat_catlog_no' => 'required|max:255|min:2',
                    'chahat_design_no' => 'required|max:255|min:2',
                    'purchase_price' => 'required|between:0,99',
                    'our_price' => 'required|between:0,99',
                    'product_type' => 'required|max:255|min:2',
                    'fabric' => 'required|max:255|min:2',
                    'ucode' => 'required|max:255|min:2',
                    'ncode' => 'required|max:255|min:2',
                    'color' => 'required|max:255|min:2',
                    'total_stock' => 'required',
                    'available_stock' => 'required',
                    'image1' => 'nullable|mimes:jpeg,jpg,png',
                    'image1' => 'nullable|mimes:jpeg,jpg,png',
                    'date' => 'required|date_format:Y-m-d',
                    'time_to_ship' => 'required|between:0,99'
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                // dd($request->all());
                DB::beginTransaction();
                $product = new Product();
                $product->rel_id = $request->rel_id;
                $product->product_name = $request->product_name;
                $product->chahat_catlog_no = $request->chahat_catlog_no;
                $product->chahat_design_no = $request->chahat_design_no;
                $product->purchase_price = $request->purchase_price;
                $product->our_price = $request->our_price;
                $product->product_type = $request->product_type;
                $product->fabric = $request->fabric;
                $product->ucode = $request->ucode;
                $product->ncode = $request->ncode;
                $product->color = $request->color;
                $product->total_stock = $request->total_stock;
                $product->available_stock = $request->available_stock;
                $product->date = $request->date;
                $product->time_to_ship = $request->time_to_ship;

                if($request->file('image1'))
                {
                    $imageName1 = time().'.'.request()->image1->getClientOriginalExtension();
                    request()->image1->move(public_path().'/backend/images/products/', $imageName1);
                    $product->image1 = 'products/'.$imageName1;
                }

                if($request->file('image2'))
                {
                    $imageName2 = time().'.'.request()->image2->getClientOriginalExtension();
                    request()->image2->move(public_path().'/backend/images/products/', $imageName2);
                    $product->image2 = 'products/'.$imageName2;
                }
                $product->save();
                $lastInsertedId= $product->id;

                // Vendor Details
                $get_user_vendor = User::where('id',Auth::guard('admin')->user()->id)->first();

                if(!empty($request->vendor_id)){
                    foreach ($request->vendor_id as $key => $vendor) {
                        $product_vendor_detail = new ProductVendorDetail();
                        $product_vendor_detail->product_id = $lastInsertedId;
                        if($request->is_show[$key] == '0'){
                            $product_vendor_detail->vendor_id = $vendor;
                            $product_vendor_detail->price = $request->price[$key];
                            $product_vendor_detail->SKU = $request->SKU[$key];
                            $product_vendor_detail->is_show = $request->is_show[$key];
                            $product_vendor_detail->save();
                        }else if($request->is_show[$key] == '1'){
                            $product_vendor_detail->vendor_id = $vendor;
                            $product_vendor_detail->price = $request->price[$key];
                            $product_vendor_detail->SKU = $request->SKU[$key];
                            $product_vendor_detail->is_show = $request->is_show[$key];
                            $product_vendor_detail->save();
                        }else{
                            if(($request->price[$key] != null) || ($request->SKU[$key] != null)){
                                $product_vendor_detail->vendor_id = $vendor;
                                $product_vendor_detail->price = $request->price[$key];
                                $product_vendor_detail->SKU = $request->SKU[$key];
                                $product_vendor_detail->save();
                            }
                        }
                    }
                }
                
                DB::commit();                
                $message = "Product stored successfully.";
                return redirect()->route('manage-product.index')->with(['message.content' => $message,'message.level' => 'success']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('manage-product.index')
                                ->with(['message.content' => $e->getMessage(),'message.level' => 'error']);           
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
                if(auth()->guard()->user()->can('edit-product')){
                    $product = Product::find($id);
                    $vendors = Vendor::with(['product_vendor_details' => function($q) use($id){
                            $q->where('product_id', $id); 
                        }])->get();
                    // $product_vendor_detail = ProductVendorDetail::where('product_id',$id)->get();
                    return view('backend/product/edit',compact('product','vendors','product_vendor_detail'));
                }else{
                    return abort('403','Forbidden');
                }
        } catch (Exception $e) {
            return redirect()->route('manage-product.index')
                                ->with(['message.content' => $e->getMessage(),'message.level' => 'error']);   
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
                $validator = Validator::make($request->all(), [
                    'rel_id'  => 'required|max:255|min:2',
                    'product_name' => 'required|max:255|min:2',
                    'chahat_catlog_no' => 'required|max:255|min:2',
                    'chahat_design_no' => 'required|max:255|min:2',
                    'purchase_price' => 'required|between:0,99',
                    'our_price' => 'required|between:0,99',
                    'product_type' => 'required|max:255|min:2',
                    'fabric' => 'required|max:255|min:2',
                    'ucode' => 'required|max:255|min:2',
                    'ncode' => 'required|max:255|min:2',
                    'color' => 'required|max:255|min:2',
                    'total_stock' => 'required',
                    'available_stock' => 'required',
                    'image1' => 'sometimes|mimes:jpeg,jpg,png',
                    'image1' => 'sometimes|mimes:jpeg,jpg,png',
                    'date' => 'required|date_format:Y-m-d',
                    'time_to_ship' => 'required|between:0,99'
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                DB::beginTransaction();
                $product = Product::find($id);
                if(!empty($product))
                {
                    $product->rel_id = $request->rel_id;
                    $product->product_name = $request->product_name;
                    $product->chahat_catlog_no = $request->chahat_catlog_no;
                    $product->chahat_design_no = $request->chahat_design_no;
                    $product->purchase_price = $request->purchase_price;
                    $product->our_price = $request->our_price;
                    $product->product_type = $request->product_type;
                    $product->fabric = $request->fabric;
                    $product->ucode = $request->ucode;
                    $product->ncode = $request->ncode;
                    $product->color = $request->color;
                    $product->total_stock = $request->total_stock;
                    $product->available_stock = $request->available_stock;
                    $product->date = $request->date;
                    $product->time_to_ship = $request->time_to_ship;

                    if($request->file('image1'))
                    {
                        if($product->image1){
                            $file = public_path('/backend/images/products/').$product->image1;
                            if (file_exists($file)) {
                                unlink($file);
                            }
                        }
                        $imageName1 = time().'.'.request()->image1->getClientOriginalExtension();
                        request()->image1->move(public_path('/backend/images/products/'), $imageName1);
                        $product->image1 = 'products/'.$imageName1;
                    }

                    if($request->file('image2'))
                    {
                        if($product->image2){
                            $file = public_path('/backend/images/products/').$product->image2;
                            if (file_exists($file)) {
                                unlink($file);
                            }
                        }
                        $imageName2 = time().'.'.request()->image2->getClientOriginalExtension();
                        request()->image2->move(public_path('/backend/images/products/'), $imageName2);
                        $product->image2 = 'products/'.$imageName2;
                    }
                    $product->save();

                    // Vendor Details
                    $get_user_vendor = User::where('id',Auth::guard('admin')->user()->id)->first();
                    if(!empty($request->vendor_id)){
                        $product->product_vendor_details()->delete();
                        foreach ($request->vendor_id as $key => $vendor) {
                            $product_vendor_detail = new ProductVendorDetail();
                            $product_vendor_detail->product_id = $id;
                            if($request->is_show[$key] == '0'){
                                $product_vendor_detail->vendor_id = $vendor;
                                $product_vendor_detail->price = $request->price[$key];
                                $product_vendor_detail->SKU = $request->SKU[$key];
                                $product_vendor_detail->is_show = $request->is_show[$key];
                                $product_vendor_detail->save();
                            }else if($request->is_show[$key] == '1'){
                                $product_vendor_detail->vendor_id = $vendor;
                                $product_vendor_detail->price = $request->price[$key];
                                $product_vendor_detail->SKU = $request->SKU[$key];
                                $product_vendor_detail->is_show = $request->is_show[$key];
                                $product_vendor_detail->save();
                            }else{
                                if(($request->price[$key] != null) || ($request->SKU[$key] != null)){
                                    $product_vendor_detail->vendor_id = $vendor;
                                    $product_vendor_detail->price = $request->price[$key];
                                    $product_vendor_detail->SKU = $request->SKU[$key];
                                    $product_vendor_detail->save();
                                }
                            }
                        }
                    }
                    /*if(!empty($request->vendor_id)){
                        $product->product_vendor_details()->delete();
                        foreach ($request->vendor_id as $key => $vendor) {
                            $product_vendor_detail = new ProductVendorDetail();
                            $product_vendor_detail->product_id = $id;
                            if(($request->price[$key] != null) || ($request->SKU[$key] != null)){
                                $product_vendor_detail->vendor_id = $vendor;
                                $product_vendor_detail->price = $request->price[$key];
                                $product_vendor_detail->SKU = $request->SKU[$key];
                                $product_vendor_detail->save();
                            }
                        }
                    }*/
                    
                    DB::commit();                
                    $message = "Product updated successfully.";
                    return redirect()->route('manage-product.index')->with(['message.content' => $message,'message.level' => 'success']);
                   
                }else{
                    return redirect()->back()
                        ->with(['message.content' => 'Product not found!!','message.level' => 'danger']);
                }   
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('manage-product.index')
                                ->with(['message.content' => $e->getMessage(),'message.level' => 'error']);   
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
                $product = Product::where('id',$id)->get();
                if(count($product) > 0)
                    {
                        Product::where('id',$id)->delete();
                        $response = array('data' => null,'status' => 1,'responseMessage' => "Product Deleted successfully.");
                    }else{
                        $response = array('data' => null,'status' => 0,'responseMessage' => "Product Not found!!.");
                    }
                    return response()->json($response)->setStatusCode(200);
            } catch (Exception $e) {
                return redirect()->route('manage-product.index')
                                ->with(['message.content' => $e->getMessage(),'message.level' => 'error']);   
            }
    }

    public function multipleProductDelete(Request $request)
    {
        try {
                $product = Product::whereIn('id',$request->ids)->get();
                if(count($product) > 0)
                {
                    Product::whereIn('id',$request->ids)->delete();
                    $response = array('data' => null,'status' => 1,'responseMessage' => "Product Deleted successfully.");
                }else{
                    $response = array('data' => null,'status' => 0,'responseMessage' => "Product Not found!!.");
                }
                return response()->json($response)->setStatusCode(200);
            } catch (Exception $e) {
                return redirect()->route('manage-product.index')
                                ->with(['message.content' => $e->getMessage(),'message.level' => 'error']);   
            }
    }
}
