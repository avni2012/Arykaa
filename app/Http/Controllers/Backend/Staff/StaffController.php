<?php

namespace App\Http\Controllers\Backend\Staff;

use App\Http\Controllers\Controller;
use Zizaco\Entrust\EntrustRole;
use Illuminate\Http\Request;
use Zizaco\Entrust\HasRole;
use App\RoleUser;
use App\Role;
use DataTables;
use Validator;
use App\User;
use App\Models\Vendor;
use Mail;
use Auth;
use Hash;
use DB;


class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            if(auth()->guard()->user()->can('list-staff')){
              if ($request->ajax()) {
                  $users = User::with('roleUser.role')->whereHas('roles', function ($query) {
                          $query->where('name', '!=', 'super_admin');
                          });
                  if(isset($request->get('order')[0]['column']) && $request->get('order')[0]['column'] == 1) {
                      $users = $users->orderBy('id','desc')->get();
                  }

                  return Datatables::of($users)
                      ->addIndexColumn()
                      ->addColumn('check',function($row){
                          $check = '';
                          if(Auth::guard()->user()->can('delete-staff'))
                              {
                              $check = '<label class="container_chk"> <input type="checkbox" value="'.$row->id.'"><span class="checkmark"></span></label>';
                              }
                              return $check;
                      })
                      ->addColumn('action', function($row){
                           $btn = '';
                           if (Auth::user()->can('edit-staff') || Auth::guard()->user()->can('delete-staff'))
                          {
                              if(Auth::user()->can('edit-staff'))
                              {
                                  $btn = '<a href="'.url('control-panel/manage-staff/'.$row->id.'/edit').'" class="edit_icon" title="Edit">
                                  <i class="fas fa-edit icon_color" ></i> </a>';
                              }
                              if(Auth::guard()->user()->can('delete-staff'))
                              {
                                  $btn = $btn . '<a href="#" onclick=
                                  deletesingle("'. $row->id.'","control-panel/manage-staff","staffDatatable") class="trash_icon" title="Delete">
                                  <i class="fas fa-trash-alt icon_color" ></i> </a>';
                              }
                          }
                              return $btn;
                      })
                       ->addColumn('status', function($row){

                              if($row->status == 1)
                              {
                                 $li = '<span class="text-success">  Active </span>';
                              }else{
                                 $li = '<span class="text-danger">  InActive </span>';
                              }
                              return $li;
                      })
                      ->addColumn('email_verified_at',function($row){
                           if($row->email_verified_at == null)
                              {
                                 $li = '<span class="text-success"> Pending  </span>';
                              }else{
                                 $li = '<span class="text-secondary"> Verify </span>';
                              }
                              return $li;
                      })
                      ->rawColumns(['action','status','email_verified_at','check'])
                      ->make(true);
              }
              return view('backend.staff.index');
            }else{
              return abort('403','Forbidden');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
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
              if(auth()->guard()->user()->can('create-staff')){
                $roles = Role::where('name','!=','super_admin')->get();
                $vendors = Vendor::get();
                return view('backend.staff.create',compact('roles','vendors'));
              }else{
                return abort('403','Forbidden');
              }
        } catch (Exception $e) {
            return $e->getMessage();
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
        try{
               DB::beginTransaction();
               $validator = Validator::make($request->all(), [
                'name'  => 'required|string|max:255|min:2',
                'email'     => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
                'mobile_no' => 'required|digits:10|min:10|unique:users,mobile_no,NULL,id,deleted_at,NULL',
                'role'      => 'required|exists:roles,id,deleted_at,NULL',
                'vendor_id'      => 'required|exists:vendors,id,deleted_at,NULL',
                'status'    => 'required',
                'password'  => 'required|min:8',
                'password_confirmation'  => 'required|min:8|same:password'
                ],[
                  'vendor_id.required' => 'The vendor field is required.'
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $user = new User;
                $user->name     = $request->name;
                $user->email        = $request->email;
                $user->mobile_no    = $request->mobile_no;
                $user->status       = $request->status;
                $user->vendor_id = $request->vendor_id;
                $user->password     = Hash::make($request->password);
                $user->email_verified_at = now();
                $user->save();

                if($roledata = Role::where('id','=',$request->role)->first())
                {
                    if (!$user->hasRole('super_admin'))
                    {
                        $user->attachRole( $roledata->id );
                    }
                }else{
                    $response = array('data' => null,'status' => 0,'responseMessage' => 'Role not found!!' );
                    return redirect()->route('manage-staff.index')
                                 ->with(['message.content' => 'Role not found!','message.level' => 'danger']);
                }

                  /*$to_email = $request->email;
                  $data = [
                      'name' => $request->name,
                      'email' => $request->email,
                      'password' => $request->password,
                      'url' => url('/').'/control-panel/login'
                      ];

                  $sendMailStatus = Mail::send('backend/staff/mail', ['data' => $data],
                            function ($message) use ($data,$to_email)
                            {
                                $message->to($to_email)->subject('Your Credentials for Login');
                            });*/

                DB::commit();
                $message = "Staff stored successfully.";
                $response = array('data' => null,'status' => 1,'responseMessage' => $message );
                return redirect()->route('manage-staff.index')
                                 ->with(['message.content' => $message,'message.level' => 'success']);

            } catch (\Exception $e) {
                DB::rollback();
                return back()->with(['message.content' =>$e->getMessage().' '.$e->getLine(), 'message.level' => 'danger']);
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
              if(auth()->guard()->user()->can('create-staff')){
                $roles = Role::where('name','!=','super_admin')->get();
                $user = User::with('roleUser.role')->where('id',$id)->first();
                $vendors = Vendor::get();
                if($user)
                {
                    return view('backend.staff.edit',compact('user','roles','vendors'));
                }else{
                    $response = array('data' => null,'status' => 0,'responseMessage' => 'User not Found!!' );
                    return redirect()->route('manage-staff.index')
                                     ->with(['message.content' => $message,'message.level' => 'danger']);
                }
              }else{
                return abort('403','Forbidden');
              }
        } catch (Exception $e) {
            return $e->getMessage();
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
              DB::beginTransaction();
               $validator = Validator::make($request->all(), [
                'name'  => 'required|string|max:255|min:2',
                'email'     => 'required|email|unique:users,email,'.$id.',id,deleted_at,NULL',
                'mobile_no' => 'required|digits:10|min:10|unique:users,mobile_no,'.$id.',id,deleted_at,NULL',
                'role'      => 'required|exists:roles,id,deleted_at,NULL',
                'vendor_id'      => 'required|exists:vendors,id,deleted_at,NULL',
                'status'    => 'required',
                'password'  => 'nullable|min:8',
                'password_confirmation'  => 'nullable|min:8|same:password'
                // 'password'  =>  'confirmed'
                ],[
                  'vendor_id.required' => 'The vendor field is required.'
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                    $user = User::findOrFail($id);
                    $user->name = $request->name;
                    $user->email    = $request->email;
                    $user->mobile_no= $request->mobile_no;
                    $user->vendor_id = $request->vendor_id;
                    $user->status   = $request->status;
                    if($request->password){
                        $user->password = Hash::make($request->password);
                    }
                    $user->save();

                    if($roledata = Role::where('id','=',$request->role)->first())
                    {
                        if (!$user->hasRole('super_admin'))
                        {
                            RoleUser::where('user_id',$user->id)->update(['role_id'=>$request->role]);
                        }

                    }else{
                        $response = array('data' => null,'status' => 0,'responseMessage' => 'Role Not Found!!' );
                        return redirect()->route('manage-staff.index')
                                 ->with(['message.content' => 'Role Not Found!','message.level' => 'success']);
                    }


                DB::commit();
                $message = "Staff updated successfully.";

                $response = array('data' => null,'status' => 1,'responseMessage' => $message );
                return redirect()->route('manage-staff.index')
                                 ->with(['message.content' => $message,'message.level' => 'success']);

        } catch (Exception $e) {
                DB::rollback();
            return $e->getMessage();
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
            DB::beginTransaction();

            User::where('id',$id)->delete();
            RoleUser::where('user_id',$id)->delete();

            DB::commit();
            $response = array('data' => null,'status' => 1,'responseMessage' => "Data Delete successfully.");
            return response()->json($response)->setStatusCode(200);

        } catch (Exception $e) {

            DB::rollback();
            $response = array('data' => null,'status' => 0,'responseMessage' => $e->getMessage());
            return response()->json($response)->setStatusCode(400);
        }
    }

    public function multipleUserDelete(Request $request)
    {
        try {
            DB::beginTransaction();
            if( User::whereIn('id',$request->ids)->get())
            {
                User::whereIn('id',$request->ids)->delete();

                if(RoleUser::whereIn('user_id',$request->ids)->get())
                {
                    RoleUser::whereIn('user_id',$request->ids)->delete();
                }
            }
             DB::commit();
            $response = array('data' => null,'status' => 1,'responseMessage' => "Data Delete successfully.");
            return response()->json($response)->setStatusCode(200);
        } catch (Exception $e) {
            DB::rollback();
            $response = array('data' => null,'status' => 0,'responseMessage' => $e->getMessage());
            return response()->json($response)->setStatusCode(400);
        }
    }
}
