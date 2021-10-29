<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Auth;
use Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/control-panel/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest:admin');
        $this->middleware('guest:admin');
    }

    protected function guard()
    {
      return Auth::guard('admin');
    }
    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param Request $request
     * @param  string|null  $token
     *
     * @return Factory|View
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('backend.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->setRememberToken(Str::random(60));
        $user->save();
      
            if($user->status == 1)
            {
                Auth::guard('admin')->login($user); 
                $notification = array(
                        'notification_message' => 'Password Set Successfully!', 
                        'alert-type' => 'success'
                    );
                return redirect('/control-panel/dashboard')->with($notification);   
            }else{
               return redirect('/control-panel/login')->with('status', 'Password Set Successfully!Please Login.');
            }
    }
}
