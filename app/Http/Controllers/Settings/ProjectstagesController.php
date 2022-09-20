<?php

namespace App\Http\Controllers\Settings;


use App\Data\Projectstages;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Response;
use DB;
use Yajra\DataTables\DataTables;

class ProjectstagesController extends Controller
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

        return view('settings.projectstages');
    }

    public function store(Request $request){

        // Projectstages::create($r);
        $projectstages = Projectstages::create($request->all());

        return Response::json($projectstages);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $churchid = Auth::user()->church_id;
       /* $projectstages = DB::table('tbl_project_stages')
            ->get();*/
        $projectstages = Projectstages::where('church_id',$churchid)->get();
        return Datatables::of($projectstages)
            ->addColumn('action', function ($projectstages) {
                return '<a href="#edit-'.$projectstages->id.'" class="btn btn-sm btn-primary" onclick="edit_project_stage(' . "'" . $projectstages->id . "'" . ')"><i class="glyphicon glyphicon-edit" ></i>Edit</a>';
            })
            ->make(true);
    }
    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $data = Projectstages::Where('id', $id)
            ->get();

        return json_encode($data);
        // return $projectstages;
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $edit = Projectstages::where('id', $id)
            ->update([
                'project_stage' =>  $request->project_stage,
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
        $data = Projectstages::where('id', $id)->delete();
        return response()->json($data);
    }

    public function phpInfo()
    {
        phpinfo();
    }
}
