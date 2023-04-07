<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    use AuthenticatesUsers {
        redirectPath as laravelRedirectPath;
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    

    public function redirectPath()
    {
        // Do your logic to flash data to session...
        session()->flash('message', 'Login Successfully');
        // Return the results of the method we are overriding that we aliased.
        return $this->laravelRedirectPath();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // $user like Auth::user, it contain info of user when login success
    protected function authenticated(Request $request, $user)
    {
        // Web user
        if ($user->role_id == 1) {
            return redirect('trang-chu');
        }

        // Admin user
        else {
            return redirect('/admin/dashboard');
        }
    }
}