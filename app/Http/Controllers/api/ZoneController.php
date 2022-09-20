<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ZoneController extends Controller
{
    public function list_zones(){
     $zones = DB::table('tbl_residential_zones')
            ->get();
        return response(['payload'=>$zones, 'message'=>'Zone Data']);
    }
    public function list_church_zones($id){
        $zones = DB::table('tbl_residential_zones')
                ->where('church_id','=',$id)
               ->get();
           return response(['payload'=>$zones, 'message'=>'Zone Data']);
       }
}
