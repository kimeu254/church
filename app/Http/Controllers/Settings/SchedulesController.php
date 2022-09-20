<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Data\Schedules;

use \Response;
use Yajra\Datatables\Datatables;


class SchedulesController extends Controller
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
       
        return view('settings.schedules');
    }
    
    public function store(Request $request){

        // schedules::create($r);
        $schedules = Schedules::create($request->all());

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
        $schedules = Schedules::where('church_id',$churchid)->get();
        return Datatables::of($schedules)
            ->addColumn('action', function ($group) {
                return '<a href="#edit-'.$group->id.'" class="btn btn-sm btn-primary" onclick="edit_schedule(' . "'" . $group->id . "'" . ')"><i class="glyphicon glyphicon-edit" ></i>Edit</a>';
            })
            ->make(true);
    }
    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $data = schedules::Where('id', $id)
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
        $edit = Schedules::where('id', $id)
                        ->update([
                            'start_time' =>  $request->end_time,
                            'end_time' =>  $request->end_time,
                            'description' =>  $request->description,
                            'maxmembers' =>  $request->maxmembers,
                            'name' => $request->name,
                            'status' =>  $request->status,
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
        $data = Schedules::where('id', $id)->delete();
        return response()->json($data);
    }

    public function phpInfo()
    {
       phpinfo();
    }
}
