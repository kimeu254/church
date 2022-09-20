<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Data\Projects;
use \Response;
use DB;
use Yajra\Datatables\Datatables;

class ProjectsController extends Controller
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
        $churchid = Auth::user()->church_id;
        $project_stage = DB::table('tbl_project_stages')->where('church_id',$churchid)->get();
        $projects = DB::table('tbl_projects')->where('church_id',$churchid)->get();

        return view('projects',[
            'projectstages' => $project_stage,
            'projects' => $projects,
        ]);


    }

    public function store(Request $request){

        //Projects::create($r);
        $projects = Projects::create($request->all());

        return Response::json($projects);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {

        //$projects = Projects::where('payment_mode','payments')->get();;
        $churchid = Auth::user()->church_id;

       /* $projects = Projects::with('project_stage')
            ->get();*/
        $projects = Projects::where('church_id',$churchid)->get();
        return Datatables::of($projects)
            ->addColumn('action', function ($projects) {
                return '<a href="#edit-'.$projects->id.'" class="btn btn-sm btn-primary" onclick="edit_project(' . "'" . $projects->id . "'" . ')"><i class="glyphicon glyphicon-edit" ></i>Edit</a>';
            })
            ->addColumn('project_stage_detail', function ($row) {
                return $row->project_stage->project_stage ?? 'No project stage';
            })
            ->make(true);
    }
    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $data = Projects::Where('id', $id)
            ->get();

        return json_encode($data);
        // return $project;
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
        $edit = Projects::where('id', $id)
            ->update([
                'project_name' =>  $request->project_name,
                'target_amount' => $request->target_amount,
                'start_date' => $request->start_date,
                'completion_date_target' => $request->completion_date_target,
                'project_stage_id' => $request->project_stage_id,
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
        $data = Projects::where('id', $id)->delete();
        return response()->json($data);
    }

    public function phpInfo()
    {
        phpinfo();
    }
}
