<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Data\Groups;

use \Response;
use Yajra\Datatables\Datatables;


class GroupsController extends Controller
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
       
        return view('settings.groups');
    }
    
    public function store(Request $request){

        // Groups::create($r);
        $groups = Groups::create($request->all());

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
        $groups = Groups::where('church_id',$churchid)->get();
        return Datatables::of($groups)
            ->addColumn('action', function ($group) {
                return '<a href="#edit-'.$group->id.'" class="btn btn-sm btn-primary" onclick="edit_group(' . "'" . $group->id . "'" . ')"><i class="glyphicon glyphicon-edit" ></i>Edit</a>';
            })
            ->make(true);
    }
    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $data = Groups::Where('id', $id)
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
        $edit = Groups::where('id', $id)
                        ->update([
                            'name' =>  $request->name,
                            'description' =>  $request->description,
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
        $data = Groups::where('id', $id)->delete();
        return response()->json($data);
    }

    public function phpInfo()
    {
       phpinfo();
    }
}
