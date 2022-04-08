<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //Fernando
    //Replace login method on AuthenticatesUsers
    //Login generate token
    //Now json input receive json output.
    public function login(Request $request)
    {
        $this->validateLogin($request);
        $login_ok = $this->attemptLogin($request);

        if ($login_ok) {
            $user = $this->guard()->user();
            $user->generateToken();
        }

        //Do metodo original
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        //login ok response to api.
        // $request have the (Accept: aplication/json) header 
        if ($login_ok && $request->wantsJson()) {
            return response()->json(['data' => $user->toArray(),]);
        }

        //login fail reponse to api.
        //$request have the (Accept: aplication/json) header 
        if (!$login_ok && $request->wantsJson()) {
            return response()->json(['error' => 'login fail.',], 401);
        }


        //Do metodo original
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        //Do metodo original
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    //Fernando
    //Replace logout method on AuthenticatesUsers
    //Login generate token
    //Now json input receive json output.
    public function logout(Request $request)
    {
        //return response()->json(['data' => $this->guard('api')->user()], 200);

        $user = $this->guard('api')->user();

        // $request have the (Accept: aplication/json) header 
        if ($user) {
            $user->api_token = null;
            $user->save();
        }

        // $request have the (Accept: aplication/json) header 
        if ($request->wantsJson()) {
            return response()->json(['data' => 'User logged out.'], 200);
        }

        $this->guard()->logout();
        if ($request->session()) $request->session()->invalidate();
        if ($request->session()) $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return redirect('/');
    }
}
