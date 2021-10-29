<?php

namespace App\Http\Controllers\Backend\ProductSub;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Validator;
use App\User;
use App\Product;
use App\AdditionalRole;
use App\Models\Vendor;
use App\Models\ProductVendorDetail;
use Auth;
use DB;
// use Illuminate\Support\Facades\Schema;

class ProductSubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{    
            $role_id = auth()->guard()->user()->roles->first()->id;
            if(auth()->guard()->user()->roles->first()->name != 'super_admin'){
                $get_keys = AdditionalRole::select('rel_id','product_name','chahat_catlog_no','chahat_design_no','purchase_price','our_price','product_type','fabric','ucode','ncode','color','total_stock','available_stock','image1','image2','date')->where('role_id',$role_id)->first()->toArray();
                $column_name_arr = array();
                foreach ($get_keys as $key => $value) {
                    if($value == 1){
                        $column_name_arr[] = $key;
                    }
                }
                // array_unshift($column_name_arr, 'No');
                $product = Product::select($column_name_arr)->get();
            }else{
                $product = Product::latest()->get();
                $column_name_arr = null;
            }
            if ($request->ajax()) {
                // $product = Product::latest()->get();
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
                        ->addColumn('image1',function($row){
                            if($row->image1 != null){
                                $image_url = asset('/backend/images/'.$row->image1);
                                $check = '<img src="' .$image_url. '" style="width: 100px;">';
                            }else{
                                $check = '';
                            }
                            return $check;
                        })
                        ->addColumn('image2',function($row){
                            if($row->image2 != null){
                                $image_url = asset('/backend/images/'.$row->image2);
                                $check = '<img src="' .$image_url. '" style="width: 100px;">';
                            }else{
                                $check = '';
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
                                 $btn = '<a href="'.url('control-panel/manage-sub-product/'.$row->id.'/edit').'" class="edit_icon" title="Edit">
                                <i class="fas fa-edit icon_color" ></i> </a>';
                            }
                            if (Auth::user()->can('delete-product'))
                            {
                                $btn = $btn . '<a onclick=deletesingle("'. $row->id .'","control-panel/manage-sub-product","productSubDatatable") title="Delete" class="trash_icon"><i class="fas fa-trash-alt icon_color" ></i> </a>';
                            }
                        }
                            return $btn;
                        })
                        ->rawColumns(['action','check','image1','image2'])
                        ->make();
            }
                return view('backend.product_sub.index',compact('product','role_id','column_name_arr'));
        } catch (\Exception $e) {
            return redirect()->route('manage-sub-product.index')
                                ->with(['message.content' => $e->getMessage(),'message.level' => 'error']);    
        }
    }

    public function getData()
    {
            $role_id = auth()->guard()->user()->roles->first()->id;
            if(auth()->guard()->user()->roles->first()->name != 'super_admin'){
                $get_keys = AdditionalRole::select('rel_id','product_name','chahat_catlog_no','chahat_design_no','purchase_price','our_price','product_type','fabric','ucode','ncode','color','total_stock','available_stock','image1','image2','date')->where('role_id',$role_id)->first()->toArray();
                $column_name_arr = array();
                foreach ($get_keys as $key => $value) {
                    if($value == 1){
                        $column_name_arr[] = $key;
                    }
                }
                // array_unshift($column_name_arr, 'No');
                $product = Product::select($column_name_arr)->get();
            }else{
                $product = Product::latest()->get();
                $column_name_arr = null;
            }
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
                                 $btn = '<a href="'.url('control-panel/manage-sub-product/'.$row->id.'/edit').'" class="edit_icon" title="Edit">
                                <i class="fas fa-edit icon_color" ></i> </a>';
                            }
                            if (Auth::user()->can('delete-product'))
                            {
                                $btn = $btn . '<a onclick=deletesingle("'. $row->id .'","control-panel/manage-sub-product","productSubDatatable") title="Delete" class="trash_icon"><i class="fas fa-trash-alt icon_color" ></i> </a>';
                            }
                        }
                            return $btn;
                        })
                        ->rawColumns(['action','check','image1'])
                        ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
