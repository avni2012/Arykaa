<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
// use Validator;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Models\Order;
use App\Product;
use App\AdditionalRole;
use App\Models\Vendor;
use App\Models\ProductVendorDetail;
use Auth;
use DB;

class OrderController extends Controller
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
            if ($request->ajax()) {
                $order = Order::latest()->get();
                return Datatables::of($order)
                        ->addIndexColumn()
                        ->addColumn('check',function($row){
                            $check = '';
                            if(Auth::guard()->user()->can('delete-order'))
                            {
                                $check = '<label class="container_chk"> <input type="checkbox" value="'.$row->id.'"><span class="checkmark"></span></label>';
                            }
                            return $check;
                        })
                        ->addColumn('action', function($row){
                        $btn ='';
                        if (Auth::user()->can('edit-order') || Auth::guard()->user()->can('delete-order'))
                        {
                            $btn = "<span class=' p-1 bg-secondary text-white border-radius ' style ='border-radius: 20px;'>Access Denied! </span>";


                            if (Auth::user()->can('edit-order'))
                            {
                                 $btn = '<a href="'.url('control-panel/manage-order/'.$row->id.'/edit').'" class="edit_icon" title="Edit">
                                <i class="fas fa-edit icon_color" ></i> </a>';
                            }
                            if (Auth::user()->can('delete-order'))
                            {
                                $btn = $btn . '<a onclick=deletesingle("'. $row->id .'","control-panel/manage-order","orderDatatable") title="Delete" class="trash_icon"><i class="fas fa-trash-alt icon_color" ></i> </a>';
                            }
                        }
                            return $btn;
                        })
                        ->rawColumns(['action','check'])
                        ->make(true);
            }
                return view('backend.order.index',compact('orders','role_id'));
        } catch (\Exception $e) {
            return redirect()->route('manage-order.index')
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
                return view('backend.order.create');
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

    public function getOrderForm($order_count)
    {
        try {
                if($order_count >= 0) {
                    $index = $order_count;
                    $returnHTML = view('backend.order.order-add',compact('index'))->render();
                    return response()->json(array('html' => $returnHTML));
                }else{
                    return response()->json(array('responseMessage' => 'Something went wrong with employment section, please try again.'), 400); 
                }
        } catch (Exception $e) {
            return redirect()->route('manage-order.index')->with(['message.content' => $e->getMessage(),'message.level' => 'error']);
        }
    }

    public function getProductName(Request $request)
    {
        try {
                if($request->product_name){
                    $get_products = Product::where('product_name','LIKE','%' .$request->product_name. '%')->get();
                    // $returnHTML = view('backend.order.order-product-sku-search',['products' => $get_products])->render();
                    // return response()->json(array('html' => $returnHTML));
                    return response()->json(array('data' => $get_products, 'responseMessage' => 'Search Products'), 200); 
                    // dd($get_products);
                }/*else{
                   return response()->json(array('responseMessage' => 'Something went wrong with employment section, please try again.'), 400);  
                }*/
        } catch (Exception $e) {
            return redirect()->route('manage-order.index')->with(['message.content' => $e->getMessage(),'message.level' => 'error']);
        }
    }

}
