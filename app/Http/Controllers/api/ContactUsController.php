<?php

namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactUsController extends Controller
{
    public function create(Request $request){
        $current_timestamp = Carbon::now()->toDateTimeString();
        $contact = DB::table('tbl_contact_us')->insert([
            'user_id' =>  $request->user_id,
            'message' =>  $request->message,
            'created_at'=>$current_timestamp,
            'updated_at'=>$current_timestamp
        ]);
        
        return response([
            'status'=> 1,
            'payload'=>$contact,
            'message'=>'Your Query has been received'
        ]);
    }
}
