<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ChurchController extends Controller
{
    public function list_churches(){
        $churches = DB::table('tbl_churches')
               ->get();
           return response(['payload'=>$churches, 'message'=>'church Data']);
       }
}
