<?php

namespace App\Http\Controllers\Backend\User;

use App\User;
use Exception;
use Throwable;
//use App\Models\Country;
use Illuminate\View\View;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Foundation\Application;
use DataTables;
use App\Http\Requests\Backend\User\StoreUserRequest;
use App\Http\Requests\Backend\User\UpdateUserRequest;
use App\Http\Requests\Backend\User\UpdateUserPasswordRequest;
use App\Http\Requests\Backend\User\Address\UpdateUserAddressRequest;
use App\Models\Industry;
use App\Mail\UpdateCustomerPassword;
use Illuminate\Support\Facades\Mail;
use App\Models\PricingSubscription;

class UserController extends Controller
{
    /**
     * @var Country[]|Collection
     */
    //private $countries;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        //$this->countries = Country::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $requesthelpers
     *
     * @return string
     */
    public function index(Request $requesthelpers)
    {
        try {
            return view('backend.users.index');
        }catch (Exception $exception){
            return $exception->getMessage();
        }
    }

    /**
     * Get User data for listing
     */
    public function getData(Request $request)
    {
        $users = User::with('roleUser.role')->whereHas('roles', function ($query) {
                        $query->where('name', '=', 'staff');
                        });
        // $users = User::doesntHave('roleUser.role');
        if(isset($request->get('order')[0]['column']) && $request->get('order')[0]['column'] == 1) {
            $users = $users->orderBy('id','desc');
        }
        return Datatables::of($users)
            ->addColumn('check',function($row){
                $check = '';
                if(Auth::user()->can('delete-user'))
                {
                    $check = '<label class="container_chk"> <input type="checkbox" value="'.$row->id.'"><span class="checkmark"></span></label>';
                }
                return $check;
            })
            ->addColumn('action', function($row){
                $btn = '';
                $editUrl = route('manage-users.edit',['id'=> $row->id]);
                $deleteUrl = route('manage-users.destroy',['id'=> $row->id]);
                $showUrl = route('manage-users.show',['id'=> $row->id]);
                $tableName = 'usersDatatable';

                if (Auth::user()->can('edit-user') || Auth::guard()->user()->can('delete-user'))
                {
                    if(Auth::user()->can('edit-user'))
                    {
                        $btn .= '<a href="'.$editUrl.'" class="edit_icon mr-2">
                                <i class="fas fa-edit icon_color" title="Edit"></i> </a>';
                    }
                    if(Auth::user()->can('delete-user'))
                    {
                        $btn .= '<a href="#" onClick="deleteTableRow(\'' . $deleteUrl . '\',)"  class="trash_icon mr-2">
                                <i class="fas fa-trash-alt icon_color" title="Delete"></i> </a>';
                    }
                }
                return $btn;
            })
            ->addColumn('status', function($row){
                return ($row->status == 1) ? '<span class="text-success">  Active </span>' : '<span class="text-secondary">  InActive </span>';
            })
            ->addColumn('email_verified_at',function($row){
                return $row->email_verified_at ? '<span class="text-secondary"> Verified </span>' : '<span class="text-success"> Pending  </span>' ;
            })
            ->addIndexColumn()
            ->rawColumns(['action','status','email_verified_at','check'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function create()
    {
        try {
            //$countries = $this->countries;
            $countries = [];
            return view('backend.users.create',compact('countries'));
        }catch (Exception $exception){
            return $exception->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        try {
            //dd($request);
            return DB::transaction(function () use ($request){
                $user = User::create([
                    "name" =>$request->input('name'),
                    //"last_name" =>$request->input('last_name'),
                    "mobile_no" => $request->input('mobile_no'),
                    "email" => $request->input('email'),
                    //"date_of_birth" => $request->input('dob'),
                    //"remarks" => $request->input('remarks'),
                    "password" =>Hash::make($request->input('password')),
                    "status" =>$request->input('status'),
                ]);
                /*$user->addresses()->create([
                    "address_line_1" => $request->input('address_line_1'),
                    "address_line_2" => $request->input('address_line_2'),
                    "address_line_3" => $request->input('address_line_3'),
                    "state_id" => $request->input('state_id'),
                    "city_id" => $request->input('city_id'),
                    "country_id" => $request->input('country_id'),
                    "post_code" => $request->input('post_code'),
                    "is_primary" => $request->input('is_primary',1)
                ]);*/
                if($user){
                    return redirect()->route('manage-users.index')
                        ->with(['message.content' => 'User has been successfully created!','message.level' => 'success']);
                }
                return redirect()->route('manage-users.index')
                    ->with(['message.content' => 'Something went wrong. Please try again later','message.level' => 'error']);
            });
        }catch (Exception $exception){
            return redirect()->route('manage-users.index')
                ->with(['message.content' => $exception->getMessage(),'message.level' => 'error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return string
     */
    public function show($id)
    {
        $user = User::findOrfail($id);
        try {
            return view('backend.users.show',compact('user'));
        }catch (Exception $exception){
            return $exception->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $manage_user
     *
     * @return string
     */
    public function edit($manage_user)
    {
        $user = User::with('user_resumes')->findOrFail($manage_user);
        $user_resumes_count = $user->user_resumes->count();
        $industry = Industry::get();
        $today_date = date('Y-m-d');
        $user_id = $manage_user;
        $user_plans_active =  PricingSubscription::with('pricing')->where('user_id' ,$user_id)
            ->Where(function ($query) use($today_date,$user_id) {
                $query->where('user_id' ,$user_id)->where('payment_status', 1)
                      ->where('pricing_expiry_date','>=',$today_date);
            })->first();
        $get_plan_history = PricingSubscription::with('pricing')->where('user_id' ,$user_id)
            ->Where(function ($query) use($today_date,$user_id) {
                $query->where('user_id' ,$user_id)->where('payment_status', 1);
            })->withTrashed()->latest()->get();
        try {
            return view('backend.users.edit',compact('user','user_resumes_count','industry','user_plans_active','get_plan_history'));
        }catch (Exception $exception){
            return redirect()->route('manage-users.index')->with(['message.content' => $exception->getMessage(),'message.level' => 'success']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param $manage_user
     *
     * @return string
     */
    public function update(UpdateUserRequest $request, $manage_user)
    {
        $user = User::findorfail($manage_user);
        try {
            return DB::transaction(function () use ($request,$user){
                $user->update([
                    "email" => $request->input('email'),
                    "date_of_birth" => $request->input('date_of_birth'),
                    "mobile_no" => $request->input('mobile_no'),
                    "gender" => $request->input('gender'),
                    "industry" => $request->input('industry'),
                    "work_experience" => $request->input('work_experience'),
                    "education_level" => $request->input('education_level'),
                    "address" => $request->get('address'),
                    "status" => $request->input('status')
                ]);
                if($user){
                    return redirect()->route('manage-users.index')
                        ->with(['message.content' => 'User has been successfully updated!','message.level' => 'success']);
                }
                return redirect()->route('manage-users.index')
                    ->with(['message.content' => 'Something went wrong. Please try again later','message.level' => 'success']);
            });
        }catch (Exception $exception){
            return $exception->getMessage();
        }

    }

    public function changeUserPassword(UpdateUserPasswordRequest $request, $manage_user)
    {
        $user = User::findorfail($manage_user);
        try {
            return DB::transaction(function () use ($request,$user){
                $user->update([
                    "password" => Hash::make($request->input('new_password'))
                ]);
                $mail_array = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => $request->input('new_password')
                ];
                Mail::to($user->email)->send(new UpdateCustomerPassword($mail_array));
                if($user){
                    return redirect()->route('manage-users.index')
                        ->with(['message.content' => 'User password has been successfully updated!','message.level' => 'success']);
                }
                return redirect()->route('manage-users.index')
                    ->with(['message.content' => 'Something went wrong. Please try again later','message.level' => 'success']);
            });
        }catch (Exception $exception){
            return redirect()->route('manage-users.index')
                    ->with(['message.content' => $exception->getMessage(),'message.level' => 'success']);
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param $manage_user
     *
     * @return JsonResponse
     */
    public function destroy($manage_user)
    {
        try {
            $user = User::find(300);
            return DB::transaction(function () use($user){
                if(!$user){
                    return responseError('User not found or invalid user id');
                }
                $user->addresses()->delete();
                $user->delete();
                return responseSuccess('User has been successfully deleted !');
            });
        }catch (Exception $exception){
            return responseError('Something weent wrong please try again later');
        }
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function multipleUserDelete(Request $request)
    {
        try {
            if(User::whereIn('id',$request->input('ids'))->delete()){
                return responseSuccess('Users has been successfully deleted !');
            }
            return responseError('Something weent wrong please try again later');
        }catch (Exception $exception){
            return responseError('Something weent wrong please try again later');
        }
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function editAddress(Request $request)
    {
        try {
            $address = UserAddress::where('user_id',$request->input('userId'))
                ->where('id',$request->input('addressId'))
                ->first();
            //$countries = $this->countries;
            $countries = [];

            if(!$address){
                return responseError('invalid address id or user id',['form'=>''],Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $html = view('backend.users.common.edit-address-form',compact('address','countries'))->render();
            return responseSuccess('form generated',['form' => $html]);
        }catch (Exception $exception){
            return responseError($exception->getMessage(),['form'=>'']);
        }
    }

    /**
     * Update user address
     *
     * @param UpdateUserAddressRequest $request
     *
     * @return JsonResponse
     */
    public function updateAddress(UpdateUserAddressRequest $request)
    {
        try {
            $address = UserAddress::where('id',$request->input('addressId'))->first();
            if(!$address){
                return responseError('invalid address id or address data not found',['form'=>''],Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $address->update([
                "address_line_1" => $request->input('address_line_1'),
                "address_line_2" => $request->input('address_line_2'),
                "address_line_3" => $request->input('address_line_3'),
                "state_id" => $request->input('state_id'),
                "city_id" => $request->input('city_id'),
                "country_id" => $request->input('country_id'),
                "post_code" => $request->input('post_code'),
            ]);
            return responseSuccess('Address has been successfully updated');

        }catch (Exception $exception ){
            return responseError($exception->getMessage(),['form'=>'']);
        }
    }

    /**
     * Delete user address
     *
     * @param Request $request
     *
     * @return JsonResponse|mixed
     */
    public function deleteAddress(Request $request)
    {
        try {
            $userAddress = UserAddress::where('id',$request->input('addressId'))->where('user_id',$request->input('userId'));
            if(!$userAddress){
                return responseError('User address not found or invalid address id');
            }
            $userAddress->delete();
            return responseSuccess('User address has been successfully deleted !');
        }catch (Exception $exception){
            return responseError('Something weent wrong please try again later');
        }
    }
}
