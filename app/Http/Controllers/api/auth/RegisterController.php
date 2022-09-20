<?php

namespace App\Http\Controllers\api\auth;

use App\Jobs\SendSms;
use App\Reset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Client;
use Route;

class RegisterController extends Controller
{
    // function create(Request $request)
    // {
    //     $this->validate($request, [
    //         'name' => ['required'],
    //         'email' => ['required', 'email', 'unique:tbl_members'],
    //         'phone_number' => ['required', 'unique:tbl_members', 'regex:^0(7(?:(?:[129][0-9])|(?:0[0-8])|(4[0-1]))[0-9]{6})$^'],
    //         'password' => ['required', 'min:6']
    //     ]);
    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'phone_number' => $request->phone_number,
    //         'password' => Hash::make($request->password)
    //     ]);
        // $code = random_int(1000000, 9000000);
        // Reset::create([
        //     'member_id' => $user->id,
        //     'code' => $code,
        //     'expires_in' => 30
        // ]);
        // $name = ucwords(strtolower($user->name));
        // $message = "Hi {$name}, your reset code for palm church app is {$code}, and expires in the next 30 minutes. Thank you.";
        // $this->dispatch(new SendSms($request->phone_number, $message));
        // return response(['message' => 'User created successfully and confirmation code sent.', 'code' => $code], 200);
    // }

   function create(Request $request)
   {
       $login = $request->validate([
           'phone_number' => 'required|String',
           'password' => 'required|String'
       ]);
       $v = validator($request->only('email', 'name', 'phone_number', 'password', 'church_id', 'residence_zone'), [           
           'residence_zone'=>'required',
           'church_id'=>'required',
           'name' => ['required'],
           'email' => 'required|string|email|max:255|unique:tbl_members',
           'phone_number' => 'required|string|max:255|unique:tbl_members',
           'password' => 'required|string|min:6',
       ]);

       if ($v->fails()) {
           return response()->json(["errors" => $v->errors()->all()], 400);
       }
       $data = request()->only('email', 'name', 'password', 'phone_number', 'residence_zone','church_id');

       $user = User::create([           
           'church_id'=>$data['church_id'],
           'residence_zone'=>$data['residence_zone'],
           'phone_number' => $data['phone_number'],
           'name' => $data['name'],
           'email' => $data['email'],
           'password' => bcrypt($data['password']),
       ]);
       $code = random_int(1000, 9000);
        Reset::create([
            'member_id' => $user->id,
            'code' => $code,
            'expires_in' => 30
        ]);
        $name = ucwords(strtolower($user->name));
        $message = "Hi {$name}, your activation code for palm church app is {$code}, and expires in the next 30 minutes. Thank you.";
        $category = "Activation";
        $churchId = $data['church_id'];
        $this->dispatch(new SendSms($request->phone_number, $message,$category,$churchId));
        $client = Client::where('password_client', 1)->first();

       $request->request->add([
           'grant_type' => 'password',
           'client_id' => $client->id,
           'client_secret' => $client->secret,
           'username' => $data['email'],
           'password' => $data['password'],
           'scope' => null,
       ]);
       $data = ['user' => Auth::user()];
       // Fire off the internal request.
       $proxy = Request::create(
           'oauth/token',
           'POST'
       );

       Route::dispatch($proxy);
       if (!Auth::attempt($login)) {
           return response(['status' => 0, 'message' => 'invalid Login Credentials'])->setStatusCode(400);
       }

       $accessToken = Auth::user()->createToken('authToken')->accessToken;
       $data = ['user' => User::with('church:id,church_name,phone_number,email_address','zone:id,zone_name')->findOrFail(Auth::id()), 'access_token' => $accessToken];
       return response(['status' => 1, 'payload' => $data, 'message' => 'User created successfully and confirmation code sent.', 'code' => $code], 200);
   }

}
