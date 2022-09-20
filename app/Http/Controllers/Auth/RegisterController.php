<?php

namespace App\Http\Controllers\Auth;

use App\Church;
use App\Data\Members;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function index(){
        return view("auth.register");
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:tbl_members',
            'phone_number' => 'required|string|max:255|unique:tbl_members',
            'national_id' => 'required|string|max:255|unique:tbl_members',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    // todo create a controller CommonController
    // todo in the controller create a function generateMembershipNumber
    // todo

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Church
     */
    protected function create(array $data)
    {
        $church = Church::create([
            'church_name' => $data['name'],
            'email_address' => $data['email'],
            'phone_number'=>$data['phone_number'],
        ]);

        $member= Members::create([
            'church_id' => $church->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'national_id' => $data['national_id'],
            'phone_number'=>$data['phone_number'],
            'status'=>"Pending",
            'password' => Hash::make($data['password']),
        ]);

        //call common controller get membership number, update current member


       /* $membership_number = ($this->membershipnumberRepo->generateMembershipNumber());*/


        return $member;

       //Email User
        $data['to']=$data['email'];
        $data['subject']="Palmchurch Account";
        $data['mailmessage']="Dear user thankyou for creating the account";
        $data['template']="email.generalemail";
        $data['sender']="info@solutechlabs.com";
        $data['sendername']="Palm Church";

       $this->sendEmail($data);
  

       
}

public function sendEmail($data)
{
    //['html' => $template], 
    $template = $data['template'];
    Mail::send($data, function ($message) use ($data) {
        $message->to($data['to'], $data['name'])->subject($data['subject']);
        $message->from($data['sender'], $data['sendername']);
    });
    
    DB::table('tbl_email_logs')->insert([
        'user_id' => $data[''],
        'email_address' => $data['to'],
        'email_subject' => $data['subject'],
        'email_description' => $data['mailmessage'],
    ]);
}

}
