<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SchedulesController extends Controller
{
    public function list_services(Request $request)
    {
        //$churchid = $request->user()->church_id;
        $userid = Auth::user()->id;
        $churchid = Auth::user()->church_id;

        $services = DB::table('tbl_schedules')
            ->where('tbl_schedules.church_id', $churchid)
            ->select('tbl_schedules.*')
            ->get();

            $data = array();
            if(!empty($services))
            {
                foreach ($services as $entry)
                {    
                    $nestedData['id'] = $entry->id;
                    $nestedData['church_id'] = $entry->church_id;
                    $nestedData['event_name'] = $entry->event_name;
                    $nestedData['servicedate'] = $entry->servicedate;
                    $nestedData['start_time'] = $entry->start_time;
                    $nestedData['end_time'] = $entry->end_time;
                    $nestedData['maxmembers'] = $entry->maxmembers;
                    $nestedData['event_status'] = $entry->event_status;
                    $nestedData['booked'] = DB::table('tbl_attendance')->where('member_id',$userid)->where('schedule_id',$entry->id)->select(DB::raw('COUNT(tbl_attendance.id) AS booked'))->value('booked');
                    $nestedData['attendees'] = DB::table('tbl_attendance')->where('schedule_id',$entry->id)->select(DB::raw('COUNT(tbl_attendance.id) AS attendees'))->value('attendees');
                    $data[] = $nestedData;
    
                }
            }
              
            $json_data = array(
                "data"=> $data   
            );
                
            //echo json_encode($json_data); 

        return response(['payload' => $json_data, 'message' => 'Services Data']);
    }

    public function bookSlot(Request $request){
        $user_count = DB::table('tbl_attendance')
                 ->where('member_id', '=', $request->user_id)
                 ->count();
        if($user_count > 1){
            return response([ 'status'=> 0, 'message'=>'Already Booked Contact Admin', 'payload'=> $user_count]);
        }
        DB::table('tbl_attendance')->insert([
            'church_id' => $request->church_id,
            'schedule_id' => $request->id,
            'member_id' => $request->user_id,
            'status' => "Booked",
            ]
        );

        return response(['status' => 1, 'message' => 'Booked Succesfully']);
    }

    public function create(Request $request, $id)
    {
        $current_timestamp = Carbon::now()->toDateTimeString();
        $schedule = DB::table('tbl_schedules')->insert([
            'user_id' => $request->user_id,
            'church_id' => $request->church_id,
            'service_id' => $request->service_id,
            'servicedate' => $current_timestamp,
            'created_at' => $current_timestamp,
        ]);
        $effect_schedule = DB::table('tbl_schedules')
                              ->leftJoin('tbl_serviceschedules', 'tbl_schedules.service_id', '=', 'tbl_serviceschedules.id' )                              
                              ->where('service_id', '=', $id)
                              ->decrement('maxmembers', 1);
      
        return response([
            'status' => 1,
            'pay1oad' => $effect_schedule,
            'message' => 'Thanks for reserving a slot'
        ]);
    }
}
