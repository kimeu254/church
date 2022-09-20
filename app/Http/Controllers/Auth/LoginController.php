<?php

namespace App\Http\Controllers\Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use DB;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'Active'])) {
                    $churchid = Auth::user()->church_id;
                    $churchname = DB::table('tbl_churches')->where('id',$churchid)->value('church_name');
                    $request->session()->put('church_name',$churchname);
                    
                    
                    return route('home');
                } else {
                    $this->sendFailedLoginResponse($request, 'Account is inactive');
                }
            } else {
                $this->sendFailedLoginResponse($request, 'Invalid credentials');
            }
        } else {
            $this->sendFailedLoginResponse($request, 'User not found!!');
        }
    }
    protected function sendFailedLoginResponse(Request $request, $message)
    {
        throw ValidationException::withMessages([
            'message' => $message,
        ])->redirectTo('login');
    }

}
