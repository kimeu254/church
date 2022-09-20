<?php

namespace App\Http\Controllers\api\auth;

use App\Jobs\SendSms;
use App\Reset;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|String',
            'password' => 'required|String'
        ]);
        if (Auth::attempt(['phone_number' => $request->phone_number, 'password' => $request->password, 'status' => 'Active'])) {
            $accessToken = $request->user()->createToken('authToken')->accessToken;
            $data = ['user' => Auth::user(), 'access_token' => $accessToken];
            return response(['status' => 1, 'payload' => $data]);
        } else {
            return response(['status' => 0, 'message' => 'Invalid Login Credentials'])->setStatusCode(400);
        }
    }

    public function resendCode(Request $request)
    {
        $this->validate($request, [
            'phone_number' => ['required']
        ]);
        $user = User::where('phone_number', $request->phone_number)->first();
        if ($user) {
            $code = random_int(1000, 9000);
            Reset::create([
                'member_id' => $user->id,
                'code' => $code,
                'expires_in' => 30
            ]);
            $name = ucwords(strtolower($user->name));
            $message = "Hi {$name}, your verification code for palm church app is {$code}, and expires in the next 30 minutes. Thank you.";
            $category = "Resend Activation";
            $churchId = DB::table('tbl_members')->where('phone_number')->value('church_id');
            $this->dispatch(new SendSms($request->phone_number, $message,$category,$churchId));
            return response()->json(['message' => 'Code sent to user successfully', 'code' => $code, 'status' => 'success'], 200);
        } else {
            return response()->json(['message' => 'No registered user with that phone number', 'status' => 'error'], 404);
        }
    }

    public function verify(Request $request)
    {
        $this->validate($request, [
            'code' => ['required'],
            'phone_number' => ['required']
        ]);
        $user = User::where('phone_number', $request->phone_number)->first();
        if ($user) {
            $code = Reset::where('member_id', $user->id)->latest()->first();
            if ($code) {
                if ($code->status == 'Active' && $code->code == $request->code && Carbon::parse($code->created_at)->addMinutes($code->expires_in) > Carbon::now()) {
                    $user->update([
                        'sms_code_verified' => 1
                    ]);
                    $code->update([
                        'status' => 'Inactive'
                    ]);
                    return response()->json(['message' => 'Account confirmation complete', 'status' => 'success'], 200);
                } else {
                    return response()->json(['message' => 'Invalid code provided or code has expired!', 'status' => 'error'], 401);
                }
            } else {
                return response()->json(['message' => 'Invalid code provided1!', 'status' => 'error'], 401);
            }
        } else {
            return response()->json(['message' => 'No registered user with that phone number', 'status' => 'error'], 404);
        }
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'phone_number' => ['required'],
            'password' => ['required', 'min:6']
        ]);
        $user = User::where('phone_number', $request->phone_number)->first();
        if ($user) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return response()->json(['message' => 'Password reset successfully', 'status' => 'success'], 200);
        } else {
            return response()->json(['message' => 'No registered user with that phone number', 'status' => 'error'], 404);
        }
    }
}
