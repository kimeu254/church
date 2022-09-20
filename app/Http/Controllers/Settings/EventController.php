<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Data\Event;

use \Response;
use Yajra\Datatables\Datatables;


class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('settings.event');
    }
    
    public function store(Request $request){

        // Event::create($r);
        $schedules = Event::create($request->all());

        return Response::json($schedules);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $churchid = Auth::user()->church_id;
        $schedules = Event::where('church_id',$churchid)->get();
        return Datatables::of($schedules)
            ->addColumn('action', function ($group) {
                return '<a href="#edit-'.$group->id.'" class="btn btn-sm btn-primary" onclick="edit_event(' . "'" . $group->id . "'" . ')"><i class="glyphicon glyphicon-edit" ></i>Edit</a>';
            })->addColumn('attendees', function ($group) {
                return DB::table('tbl_attendance')->where('schedule_id',$group->id)->select(DB::raw('COUNT(tbl_attendance.id) AS attendees'))->value('attendees');
            })
            ->make(true);
    }
    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $data = Event::Where('id', $id)
                            ->get();

        return json_encode($data);
        // return $region;
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $edit = Event::where('id', $id)
                        ->update([
                            'start_time' =>  $request->start_time,
                            'end_time' =>  $request->end_time,
                            'event_name' =>  $request->event_name,
                            'servicedate' =>  $request->servicedate,
                            'maxmembers' =>  $request->maxmembers,
                            'event_status' =>  $request->event_status,
                            'church_id' =>  $request->church_id,
                        ]);
        return response()->json($edit);

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $data = Event::where('id', $id)->delete();
        return response()->json($data);
    }

    public function phpInfo()
    {
       phpinfo();
    }
}
