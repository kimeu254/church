<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Data\Zones;
use \Response;
use Yajra\Datatables\Datatables;


class ZonesController extends Controller
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
//       Zones::withCount('members')->get();
        return view('settings.zones');
    }
    
    public function store(Request $request){

        // Zones::create($r);
        $groups = Zones::create($request->all());

        return Response::json($groups);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $churchid = Auth::user()->church_id;
        $groups = Zones::where('church_id',$churchid)->get();
        return Datatables::of($groups)
            ->addColumn('action', function ($group) {
                return '<a href="#edit-'.$group->id.'" class="btn btn-sm btn-primary" onclick="edit_zones(' . "'" . $group->id . "'" . ')"><i class="glyphicon glyphicon-edit" ></i>Edit</a>';
            })
            ->make(true);
    }
    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $data = Zones::Where('id', $id)
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
        $edit = Zones::where('id', $id)
                        ->update([
                            'zone_name' =>  $request->zone_name,
                            'church_id' =>  $request->church_id,
                            'status' =>  $request->status,
                        ]);
        return response()->json($edit);

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $data = Zones::where('id', $id)->delete();
        return response()->json($data);
    }

    public function phpInfo()
    {
       phpinfo();
    }
}
