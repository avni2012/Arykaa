<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }
    
    protected $redirectTo = '/control-panel/dashboard';

    /**
     * Show the application's login form.
     *
     * @return Application|Factory|Response|View
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(\Illuminate\Http\Request $request) {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        // This section is the only change
        if ($this->guard('admin')->validate($this->credentials($request))) {
            $user = $this->guard('admin')->getLastAttempted();

            // Make sure the user is active
            if ($user->status == 1  && $this->attemptLogin($request)) {
                    // Send the normal successful login response
                    return $this->sendLoginResponse($request);
                } else {
                    // Increment the failed login attempts and redirect back to the
                    // login form with an error message.
                    $this->incrementLoginAttempts($request);
                    return redirect()
                        ->back()
                        ->withInput($request->only($this->username(), 'remember'))
                        ->withErrors([$this->username() => 'Sorry, you are inactive for now.']);
                }
            /*if($user->is_admin == 1 && $user->roles)
            {
                if ($user->status == 1  && $this->attemptLogin($request)) {
                    // Send the normal successful login response
                    return $this->sendLoginResponse($request);
                } else {
                    // Increment the failed login attempts and redirect back to the
                    // login form with an error message.
                    $this->incrementLoginAttempts($request);
                    return redirect()
                        ->back()
                        ->withInput($request->only($this->username(), 'remember'))
                        ->withErrors([$this->username() => 'Sorry, you are inactive for now.']);
                }
            }else{
                $this->incrementLoginAttempts($request);
                    return redirect()
                        ->back()
                        ->withInput($request->only($this->username(), 'remember'))
                        ->withErrors([$this->username() => 'Sorry, You are not Staff/Admin Member.']);
            }*/
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    /**
     * Log the user out of the application.
     *
     * @param Request $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return $this->loggedOut($request) ?: redirect('/control-panel/login');
    }

}
