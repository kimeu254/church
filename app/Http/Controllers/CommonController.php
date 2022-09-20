<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Data\Members;
use \Response;
use DB;
use Yajra\Datatables\Datatables;

class CommonController extends Controller

{
    protected $repo;

    /* public function __construct(Request $request)
     {
         $this->middleware('auth');
     }*/
    public function generateMembershipNumber()
    {
        $churchid = Auth::user()->church_id;
       /* $count = Members::where('church_id', $churchid)->count() + 1;*/
        $abbreviation = 'M';
        $memberNumber = $abbreviation . str_pad( + 1, 3, '0', STR_PAD_LEFT);
        /*$taken = Members::where('church_id', Auth::user()->church_id)
            ->where('membership_number', $memberNumber)
            ->exists();
        if ($taken) {
            // add one, check if t
        }*/
        return $memberNumber;
    }
}
