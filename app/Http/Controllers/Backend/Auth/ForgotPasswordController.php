<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\View\View;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\User;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('guest');
    }*/
    protected function guard()
    {
        return Auth::guard('admin');
    }
    public function __construct()
    {
        // $this->middleware('guest');
        $this->middleware('guest:admin');
    }
    protected function broker()
    {
        return Password::broker('users');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return Application|Factory|Response|View
     */
    public function showLinkRequestForm()
    {
        return view('backend.auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        try{
            $this->validate($request, ['email' => 'required|email']);
            $user = User::where('email',$request->email)->first();
            if(empty($user))
            {
                return back()->with('status', 'This email is UnRegister.');
            }else{
              if($user->is_admin == 1 && $user->roles)
             {
                if($user->status == 1)
                {
                    $response = $this->broker()->sendResetLink(
                        $request->only('email')
                    );
                    if ($response === Password::RESET_LINK_SENT) {
                        return back()->with('status', trans($response));
                    }
                }else{
                    return back()->with('status', 'Your account is not activated. Please activate it first.');
                }
             }else{
                return back()->with('status', 'Sorry, You are not Staff memebr.');
             }  
            }
        }catch(Exception $e){
            return redirect()->back()->with($e->getMessage());
        }
    }
}
