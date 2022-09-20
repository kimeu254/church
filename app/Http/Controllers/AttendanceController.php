<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     
     $churchid = Auth::user()->church_id;
     $schedules = DB::table('tbl_schedules')->where('church_id',$churchid)->get();
     return view('attendance', compact('schedules'));
    }


    public function allData(Request $request) {
        $eventid = $request->event_id;
        $churchid = Auth::user()->church_id;
        $members = DB::table("tbl_attendance")
        ->join('tbl_members','tbl_members.id','=','tbl_attendance.member_id')
        ->join('tbl_schedules','tbl_schedules.id','=','tbl_attendance.schedule_id')
        ->join('tbl_churches','tbl_churches.id','=','tbl_attendance.church_id')
        ->select('tbl_attendance.*','tbl_members.name','church_name','event_name','servicedate','start_time','end_time','changetime','tbl_schedules.created_at AS addedat')
        ->where('tbl_members.church_id',$churchid)
        ->where('tbl_attendance.schedule_id',$eventid)->get();

        return Datatables::of($members)
            ->addColumn('action', function ($member) {
                return '<a href="#admit" class="btn btn-sm btn-primary" onclick="admit(' . "'" . $member->id . "'" . ')">Admit</a>
                    <a href="#cancel" title="Cancel Slot" class="btn btn-success btn-sm" onclick="cancel(' . "'" . $member->id . "'" . ')"> Cancel</a>';
            })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function admitUser($attendance_id){
        date_default_timezone_set("Africa/Nairobi");
        $datetimenow=date("Y-m-d H:i:s");
        $edit = DB::table('tbl_attendance')->where('id', $attendance_id)
        ->update([
            'changeby' => Auth::user()->id,
            'changetime' =>  $datetimenow,
            'status' => 'Attended',
        ]);
return response()->json($edit);
    }

    public function cancelUser($attendance_id){
        date_default_timezone_set("Africa/Nairobi");
        $datetimenow=date("Y-m-d H:i:s");
        $edit = DB::table('tbl_attendance')->where('id', $attendance_id)
        ->update([
            'changeby' => Auth::user()->id,
            'changetime' =>  $datetimenow,
            'status' => 'Cancelled',
        ]);
return response()->json($edit);
    }
}